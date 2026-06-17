<?php

namespace App\Http\Controllers\Representative;

use App\Http\Controllers\Controller;
use App\Models\AidDistribution;
use App\Models\AidBeneficiary;
use App\Models\AidType;
use App\Models\Family;
use App\Models\FamilyMember;
use App\Models\Inventory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DistributionController extends Controller
{
    private function getCampId()
    {
        return Auth::user()->representative->camp_id;
    }

    public function index()
    {
        $campId = $this->getCampId();
        $distributions = AidDistribution::where('camp_id', $campId)->get();
        $inventory = Inventory::where('camp_id', $campId)->get();
        return view('representative.distributions.index', compact('distributions', 'inventory'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'inventory_id' => 'required|exists:inventory,id',
            'quantity' => 'required|integer|min:1',
            'for' => 'nullable|string',
        ]);

        $campId = $this->getCampId();

        $distribution = AidDistribution::create([
            'camp_id' => $campId,
            'inventory_id' => $request->inventory_id,
            'quantity' => $request->quantity,
            'for' => $request->for,
            'status' => 'pending',
        ]);

        // توزيع ذكي — إيجاد المستفيدين تلقائياً
        $inventory = Inventory::find($request->inventory_id);
        $aidType = $inventory ? AidType::where('inventory_id', $inventory->id)->first() : null;

        if ($aidType) {
            if ($aidType->for == 'family') {
                $families = Family::where('camp_id', $campId)->get();
                foreach ($families as $family) {
                    AidBeneficiary::create([
                        'aid_distributions_id' => $distribution->id,
                        'families_id' => $family->id,
                        'status' => 'pending',
                    ]);
                }
            } else {
                $members = FamilyMember::whereHas('family', function($q) use ($campId) {
                    $q->where('camp_id', $campId);
                });

                if ($aidType->gender) {
                    $members = $members->where('gender', $aidType->gender);
                }
                if ($aidType->isForInjured) {
                    $members = $members->where('is_injured', 1);
                }
                if ($aidType->isForPhysicalDisability) {
                    $members = $members->where('have_physical_diability', 1);
                }
                if ($aidType->isForWhoNeedDiapers) {
                    $members = $members->where('need_diapers', 1);
                }
                if ($aidType->isForLacting) {
                    $members = $members->where('is_lacting', 1);
                }
                if ($aidType->isForPregnent) {
                    $members = $members->where('is_pregnent', 1);
                }

                foreach ($members->get() as $member) {
                    AidBeneficiary::create([
                        'aid_distributions_id' => $distribution->id,
                        'family_members_id' => $member->id,
                        'families_id' => $member->families_id,
                        'status' => 'pending',
                    ]);
                }
            }
        }

        return redirect()->route('representative.distributions.index')
            ->with('success', 'تم إنشاء التوزيع بنجاح');
    }

    public function beneficiaries(AidDistribution $distribution)
    {
        $beneficiaries = AidBeneficiary::where('aid_distributions_id', $distribution->id)
            ->with(['family', 'member'])
            ->get();
        return view('representative.distributions.beneficiaries', compact('distribution', 'beneficiaries'));
    }

    public function confirm(AidDistribution $distribution)
    {
        $distribution->update([
            'status' => 'confirmed',
            'confirmed_at' => now(),
        ]);

        AidBeneficiary::where('aid_distributions_id', $distribution->id)
            ->update(['status' => 'received']);

        $inventory = Inventory::find($distribution->inventory_id);
        if ($inventory) {
            $inventory->increment('distributed_q', $distribution->quantity);
        }

        return redirect()->route('representative.distributions.index')
            ->with('success', 'تم تأكيد التوزيع بنجاح');
    }
}
