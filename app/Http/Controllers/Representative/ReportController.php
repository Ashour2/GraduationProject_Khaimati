<?php

namespace App\Http\Controllers\Representative;

use App\Http\Controllers\Controller;
use App\Models\Family;
use App\Models\FamilyMember;
use App\Models\Inventory;
use App\Models\Camp;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReportController extends Controller
{
    private function getCampId()
    {
        return Auth::user()->representative->camp_id;
    }

    public function index(Request $request)
    {
        $campId = $this->getCampId();
        $camp = Camp::find($campId);

        // إذا طُلب نوع تقرير، نولّد ملف PDF
        if ($request->filled('type')) {
            return $this->generate($request, $camp);
        }

        return view('representative.reports.index', compact('camp'));
    }

    private function generate(Request $request, Camp $camp)
    {
        $type = $request->query('type');
        $campId = $camp->id;
        $date = now()->format('Y-m-d');

        switch ($type) {
            case 'all_beneficiaries':
                $families = Family::where('camp_id', $campId)
                    ->with('members')
                    ->get();
                $pdf = Pdf::loadView('representative.reports.pdf.all_beneficiaries', compact('camp', 'families'));
                return $pdf->download("all_beneficiaries_{$date}.pdf");

            case 'inventory':
                $inventory = Inventory::where('camp_id', $campId)->get();
                $pdf = Pdf::loadView('representative.reports.pdf.inventory', compact('camp', 'inventory'));
                return $pdf->download("inventory_report_{$date}.pdf");

            case 'camp':
                $familiesCount = Family::where('camp_id', $campId)->count();
                $membersCount = FamilyMember::whereHas('family', function ($q) use ($campId) {
                    $q->where('camp_id', $campId);
                })->count();
                $pdf = Pdf::loadView('representative.reports.pdf.camp', compact('camp', 'familiesCount', 'membersCount'));
                return $pdf->download("camp_report_{$date}.pdf");

            case 'family':
                $nationalId = $request->query('national_id_no');
                $family = Family::where('camp_id', $campId)
                    ->where('national_id_no', $nationalId)
                    ->with('members')
                    ->first();

                if (!$family) {
                    return redirect()->route('representative.reports.index')
                        ->with('error', 'لا توجد عائلة بهذا الرقم في مخيمك');
                }

                $pdf = Pdf::loadView('representative.reports.pdf.family', compact('camp', 'family'));
                return $pdf->download("family_{$nationalId}_{$date}.pdf");

            default:
                return redirect()->route('representative.reports.index')
                    ->with('error', 'نوع تقرير غير معروف');
        }
    }
}
