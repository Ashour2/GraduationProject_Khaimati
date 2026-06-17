<?php

namespace App\Http\Controllers;

use App\Models\Camp;
use App\Models\User;
use App\Models\DataEntry;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DataEntryController extends Controller
{
    use Traits\DashboardData;

    public function create()
    {
        $camps = Camp::all();

        return view('dashboard.dashboard', array_merge(
            $this->dashboardData(),
            [
                'section' => 'data-entries',
                'subsection' => 'create-data-entry',
                'camps' => $camps,
            ]
        ));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'camp_id' => 'required|exists:camps,id',
            'name' => 'required|string|max:150',
            'email' => 'required|email|max:150|unique:users,email|unique:data_entries,email',
            'phone' => 'nullable|string|max:20',
            'password' => 'required|string|min:8',
        ]);

        DB::transaction(function () use ($validated) {
            $hashedPassword = Hash::make($validated['password']);

            $user = User::create([
                'name' => $validated['name'],
                'email' => $validated['email'],
                'password' => $hashedPassword,
                'role' => 'data_entry',
                'is_active' => true,
                'phone' => $validated['phone'] ?? null,
            ]);

            DataEntry::create([
                'user_id' => $user->id,
                'camp_id' => $validated['camp_id'],
                'name' => $validated['name'],
                'email' => $validated['email'],
                'phone' => $validated['phone'] ?? null,
                'password' => $hashedPassword,
                'status' => 'active',
            ]);
        });

        return back()->with('success', 'تم إضافة مدخل البيانات بنجاح');
    }
}
