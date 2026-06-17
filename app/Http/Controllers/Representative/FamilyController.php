<?php

namespace App\Http\Controllers\Representative;

use App\Http\Controllers\Controller;
use App\Models\Family;
use App\Models\FamilyMember;
use Illuminate\Support\Facades\Auth;

class FamilyController extends Controller
{
    public function index()
    {
        $representative = Auth::user()->representative;
        $families = Family::where('camp_id', $representative->camp_id)->get();
        return view('representative.families.index', compact('families'));
    }

    public function members(Family $family)
    {
        $members = FamilyMember::where('families_id', $family->id)->get();
        return view('representative.families.members', compact('family', 'members'));
    }
}
