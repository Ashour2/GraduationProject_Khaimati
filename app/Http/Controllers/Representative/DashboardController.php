<?php

namespace App\Http\Controllers\Representative;

use App\Http\Controllers\Controller;
use App\Models\Family;
use App\Models\FamilyMember;
use App\Models\DataEntry;
use App\Models\Supporter;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $representative = Auth::user()->representative;

        if (!$representative) {
            abort(403, 'هذا الحساب غير مرتبط بمخيم');
        }

        $campId = $representative->camp_id;

        $familiesCount = Family::where('camp_id', $campId)->count();
        $membersCount = FamilyMember::whereHas('family', function($q) use ($campId) {
            $q->where('camp_id', $campId);
        })->count();
        $dataEntriesCount = DataEntry::where('camp_id', $campId)->count();
        $supportersCount = Supporter::whereHas('camps', function($q) use ($campId) {
            $q->where('camps.id', $campId);
        })->count();

        return view('representative.dashboard', compact(
            'familiesCount',
            'membersCount',
            'dataEntriesCount',
            'supportersCount',
            'representative'
        ));
    }
}
