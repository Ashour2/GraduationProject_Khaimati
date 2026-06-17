<?php

namespace App\Http\Controllers\Representative;

use App\Http\Controllers\Controller;
use App\Models\DataEntry;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class DataEntryController extends Controller
{
    private function getCampId()
    {
        return Auth::user()->representative->camp_id;
    }

    public function index()
    {
        $dataEntries = DataEntry::where('camp_id', $this->getCampId())->get();
        return view('representative.data-entries.index', compact('dataEntries'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:150',
            'email' => 'required|email|unique:users,email',
            'phone' => 'nullable|string|max:20',
            'password' => 'required|string|min:6',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'data_entry',
            'is_active' => true,
            'phone' => $request->phone,
        ]);

        DataEntry::create([
            'user_id' => $user->id,
            'camp_id' => $this->getCampId(),
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => Hash::make($request->password),
            'status' => 'active',
        ]);

        return redirect()->route('representative.data-entries.index')
            ->with('success', 'تم إضافة مدخل البيانات بنجاح');
    }

    public function update(Request $request, DataEntry $dataEntry)
    {
        $request->validate([
            'name' => 'required|string|max:150',
            'phone' => 'nullable|string|max:20',
        ]);

        $dataEntry->update([
            'name' => $request->name,
            'phone' => $request->phone,
        ]);

        if ($dataEntry->user) {
            $dataEntry->user->update([
                'name' => $request->name,
                'phone' => $request->phone,
            ]);
        }

        return redirect()->route('representative.data-entries.index')
            ->with('success', 'تم تعديل البيانات بنجاح');
    }

    public function toggle(DataEntry $dataEntry)
    {
        $newStatus = $dataEntry->status === 'active' ? 'inactive' : 'active';
        $dataEntry->update(['status' => $newStatus]);

        if ($dataEntry->user) {
            $dataEntry->user->update(['is_active' => $newStatus === 'active']);
        }

        return redirect()->route('representative.data-entries.index')
            ->with('success', 'تم تغيير حالة المدخل بنجاح');
    }

    public function updatePassword(Request $request, DataEntry $dataEntry)
    {
        $request->validate([
            'password' => 'required|string|min:6|confirmed',
        ]);

        $dataEntry->update(['password' => Hash::make($request->password)]);

        if ($dataEntry->user) {
            $dataEntry->user->update(['password' => Hash::make($request->password)]);
        }

        return redirect()->route('representative.data-entries.index')
            ->with('success', 'تم تغيير كلمة المرور بنجاح');
    }
}
