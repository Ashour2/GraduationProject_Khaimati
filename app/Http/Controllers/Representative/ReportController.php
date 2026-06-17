<?php

namespace App\Http\Controllers\Representative;

use App\Http\Controllers\Controller;
use App\Models\Family;
use App\Models\FamilyMember;
use App\Models\Inventory;
use App\Models\Camp;
use Illuminate\Support\Facades\Auth;

class ReportController extends Controller
{
    public function index()
    {
        $campId = Auth::user()->representative->camp_id;
        $camp = Camp::find($campId);
        return view('representative.reports.index', compact('camp'));
    }
}
