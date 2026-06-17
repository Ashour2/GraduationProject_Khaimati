<?php

namespace App\Http\Controllers;

use App\Models\Camp;
use App\Models\User;
use App\Models\Supporter;
use App\Models\Message;
use App\Models\RegistrationRequest;
use App\Models\Representative;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class RequestController extends Controller
{
    private function getSharedData()
    {
        return [
            'campsCount' => Camp::count(),
            'adminsCount' => User::where('role', 'admin')->count(),
            'representativesCount' => User::where('role', 'representative')->count(),
            'dataEntriesCount' => User::where('role', 'data_entry')->count(),
            'supportersCount' => Supporter::count(),
            'messagesCount' => Message::count(),
            'camps' => Camp::all(),
            'requests' => RegistrationRequest::latest('created_at')->get(),
            'messages' => Message::latest('created_at')->get(),
        ];
    }

    public function index()
    {
        $data = $this->getSharedData();
        $data['section'] = 'requests';

        return view('dashboard.dashboard', $data);
    }

    public function show($id)
    {
        $data = $this->getSharedData();
        $data['selectedRequest'] = RegistrationRequest::findOrFail($id);
        $data['section'] = 'requests';
        $data['subsection'] = 'show-request';

        return view('dashboard.dashboard', $data);
    }

    public function approve($id)
    {
        $requestRecord = RegistrationRequest::findOrFail($id);

        if ($requestRecord->status !== 'pending') {
            return redirect()->route('requests.show', $id)
                ->with('error', 'تمت معالجة هذا الطلب مسبقًا');
        }

        DB::transaction(function () use ($requestRecord) {
            $camp = Camp::create([
                'name' => $requestRecord->camp_name,
                'location' => $requestRecord->location,
                'governorate' => $requestRecord->governorate,
                'families_count' => $requestRecord->families_count,
                'status' => 'active',
            ]);

            $defaultPassword = '12345678';
            $hashedPassword = Hash::make($defaultPassword);

            $user = User::create([
                'name' => $requestRecord->rep_name,
                'email' => $requestRecord->email,
                'email_verified_at' => now(),
                'password' => $hashedPassword,
                'role' => 'representative',
                'is_active' => true,
                'phone' => $requestRecord->phone,
            ]);

            Representative::create([
                'user_id' => $user->id,
                'camp_id' => $camp->id,
                'name' => $requestRecord->rep_name,
                'email' => $requestRecord->email,
                'password' => $hashedPassword,
                'phone' => $requestRecord->phone,
                'gender' => $requestRecord->gender,
                'national_id_no' => $requestRecord->national_id_no,
                'governorate' => $requestRecord->governorate,
                'national_id_img_path' => $requestRecord->national_id_img_path,
                'personal_img_path' => $requestRecord->personal_img_path,
                'verification_img_path' => $requestRecord->verification_img_path,
                'status' => 'active',
            ]);

            $requestRecord->status = 'approved';
            $requestRecord->save();
        });

        return redirect()->route('requests.show', $id)->with('success', 'تم قبول الطلب وإنشاء المخيم والمندوب');
    }

    public function reject($id)
    {
        $requestRecord = RegistrationRequest::findOrFail($id);

        if ($requestRecord->status !== 'pending') {
            return redirect()->route('requests.show', $id)
                ->with('error', 'تمت معالجة هذا الطلب مسبقًا');
        }

        $requestRecord->status = 'rejected';
        $requestRecord->save();

        return redirect()->route('requests.show', $id)->with('success', 'تم رفض الطلب');
    }
}
