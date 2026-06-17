<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Representative;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    use Traits\DashboardData;

    public function passwordForm(User $user)
    {
        return view('dashboard.dashboard', array_merge(
            $this->dashboardData(),
            [
                'section' => 'users',
                'subsection' => 'change-user-password',
                'selectedUser' => $user,
            ]
        ));
    }

    public function updatePassword(Request $request, User $user)
    {
        $validated = $request->validate([
            'password' => 'required|string|min:8|confirmed',
        ]);

        $hashedPassword = Hash::make($validated['password']);

        DB::transaction(function () use ($user, $hashedPassword) {
            $user->update([
                'password' => $hashedPassword,
            ]);

            if ($user->role === 'representative' && $user->representative) {
                $user->representative->update([
                    'password' => $hashedPassword,
                ]);
            }

            if ($user->role === 'data_entry' && $user->dataEntry) {
                $user->dataEntry->update([
                    'password' => $hashedPassword,
                ]);
            }

            if ($user->role === 'admin' && $user->adminProfile) {
                $user->adminProfile->update([
                    'password' => $hashedPassword,
                ]);
            }
        });

        return redirect()->route('users.index')->with('success', 'تم تغيير كلمة المرور بنجاح');
    }

    public function toggleStatus(User $user)
    {
        $newIsActive = !$user->is_active;

        DB::transaction(function () use ($user, $newIsActive) {
            $user->update([
                'is_active' => $newIsActive,
            ]);

            if ($user->role === 'representative' && $user->representative) {
                $user->representative->update([
                    'status' => $newIsActive ? 'active' : 'inactive',
                ]);
            }

            if ($user->role === 'data_entry' && $user->dataEntry) {
                $user->dataEntry->update([
                    'status' => $newIsActive ? 'active' : 'inactive',
                ]);
            }
        });

        return redirect()->route('users.index')->with('success', 'تم تحديث حالة المستخدم');
    }
}
