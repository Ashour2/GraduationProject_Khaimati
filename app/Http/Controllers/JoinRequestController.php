<?php

namespace App\Http\Controllers;

use App\Models\Communication;
use App\Models\RegistrationRequest;
use Illuminate\Http\Request;

class JoinRequestController extends Controller
{
    public function create()
    {
        $communications = Communication::pluck('value', 'name')->toArray();
        return view('public.join', compact('communications'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'camp_name' => 'required|string|max:150',
            'governorate' => 'required|string|max:100',
            'location' => 'required|string|max:150',
            'families_count' => 'required|integer|min:1',

            'rep_name' => 'required|string|max:150',
            'gender' => 'required|string|max:20',
            'national_id_no' => 'required|string|max:20',
            'email' => 'required|email|max:150',
            'phone' => 'required|string|max:20',

            'national_id_img' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'personal_img' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'verification_img' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $joinRequest = RegistrationRequest::create([
            'camp_name' => $validated['camp_name'],
            'governorate' => $validated['governorate'],
            'location' => $validated['location'],
            'families_count' => $validated['families_count'],

            'rep_name' => $validated['rep_name'],
            'gender' => $validated['gender'],
            'national_id_no' => $validated['national_id_no'],
            'email' => $validated['email'],
            'phone' => $validated['phone'],
            'status' => 'pending',
        ]);

        $folder = 'requests/request_' . $joinRequest->id;

        if ($request->hasFile('national_id_img')) {
            $joinRequest->national_id_img_path =
                $request->file('national_id_img')->storeAs($folder, 'national_id.' . $request->file('national_id_img')->extension(), 'public');
        }

        if ($request->hasFile('personal_img')) {
            $joinRequest->personal_img_path =
                $request->file('personal_img')->storeAs($folder, 'personal.' . $request->file('personal_img')->extension(), 'public');
        }

        if ($request->hasFile('verification_img')) {
            $joinRequest->verification_img_path =
                $request->file('verification_img')->storeAs($folder, 'verification.' . $request->file('verification_img')->extension(), 'public');
        }

        $joinRequest->save();

        return back()->with('success', 'تم إرسال طلب الانضمام بنجاح');
    }
}