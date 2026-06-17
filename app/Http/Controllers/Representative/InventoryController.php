<?php

namespace App\Http\Controllers\Representative;

use App\Http\Controllers\Controller;
use App\Models\Inventory;
use App\Models\AidType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InventoryController extends Controller
{
    private function getCampId()
    {
        return Auth::user()->representative->camp_id;
    }

    public function index()
    {
        $campId = $this->getCampId();
        $inventory = Inventory::where('camp_id', $campId)->get();
        return view('representative.inventory.index', compact('inventory'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'package_name' => 'required|string|max:150',
            'description' => 'nullable|string',
            'recived_q' => 'required|integer|min:0',
        ]);

        Inventory::create([
            ...$request->except(['_token']),
            'camp_id' => $this->getCampId(),
            'distributed_q' => 0,
        ]);

        return redirect()->route('representative.inventory.index')
            ->with('success', 'تم إضافة المخزون بنجاح');
    }

    public function aidTypes()
    {
        $campId = $this->getCampId();
        $aidTypes = AidType::where('camp_id', $campId)->get();
        $inventory = Inventory::where('camp_id', $campId)->get();
        return view('representative.inventory.aid-types', compact('aidTypes', 'inventory'));
    }

    public function storeAidType(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:100',
            'for' => 'nullable|string',
            'gender' => 'nullable|string',
            'min_age' => 'nullable|integer',
            'max_age' => 'nullable|integer',
            'inventory_id' => 'nullable|exists:inventory,id',
        ]);

        AidType::create([
            ...$request->except(['_token']),
            'camp_id' => $this->getCampId(),
            'isForInjured' => $request->isForInjured ?? 0,
            'isForPhysicalDisability' => $request->isForPhysicalDisability ?? 0,
            'isForWhoNeedDiapers' => $request->isForWhoNeedDiapers ?? 0,
            'isForLacting' => $request->isForLacting ?? 0,
            'isForPregnent' => $request->isForPregnent ?? 0,
        ]);

        return redirect()->route('representative.inventory.aid-types')
            ->with('success', 'تم إضافة نوع المساعدة بنجاح');
    }
}
