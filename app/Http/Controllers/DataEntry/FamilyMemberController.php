<?php

namespace App\Http\Controllers\DataEntry;

use App\Http\Controllers\Controller;
use App\Models\Family;
use App\Models\FamilyMember;
use App\Services\ChangeLogService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FamilyMemberController extends Controller
{
    public function index(Family $family)
    {
        $members = FamilyMember::where('families_id', $family->id)->get();
        return view('data-entry.members.index', compact('family', 'members'));
    }

    public function create(Family $family)
    {
        return view('data-entry.members.create', compact('family'));
    }

    public function store(Request $request, Family $family)
    {
        $request->validate([
            'name' => 'required|string|max:100',
            'national_id_no' => 'nullable|string|max:20',
            'gender' => 'nullable|string',
            'birthday' => 'nullable|date',
            'relation_to_guardian' => 'nullable|string|max:50',
            'maritral_status' => 'nullable|string',
            'phone' => 'nullable|string|max:20',
            'alt_phone' => 'nullable|string|max:20',
            'email' => 'nullable|email|max:150',
            'is_injured' => 'nullable',
            'have_physical_diability' => 'nullable',
            'need_diapers' => 'nullable',
            'medical_eq_needed' => 'nullable|string',
            'is_lacting' => 'nullable',
            'is_pregnent' => 'nullable',
        ]);

        $member = FamilyMember::create([
            ...$request->except(['_token', 'needs_medical']),
            'families_id' => $family->id,
            'is_injured' => $request->is_injured ?? 0,
            'have_physical_diability' => $request->have_physical_diability ?? 0,
            'need_diapers' => $request->need_diapers ?? 0,
            'is_lacting' => $request->is_lacting ?? 0,
            'is_pregnent' => $request->is_pregnent ?? 0,
        ]);

        $dataEntry = Auth::user()->dataEntry;

        ChangeLogService::log(
            $dataEntry->camp_id,
            'إضافة فرد',
            $member->id,
            'FamilyMember'
        );

        return redirect()->route('data-entry.families.members', $family->id)
            ->with('success', 'تم إضافة الفرد بنجاح');
    }

    public function show(Family $family, FamilyMember $member)
    {
        return view('data-entry.members.show', compact('family', 'member'));
    }

    public function edit(Family $family, FamilyMember $member)
    {
        return view('data-entry.members.edit', compact('family', 'member'));
    }

    public function update(Request $request, Family $family, FamilyMember $member)
    {
        $request->validate([
            'name' => 'required|string|max:100',
            'national_id_no' => 'nullable|string|max:20',
            'gender' => 'nullable|string',
            'birthday' => 'nullable|date',
            'relation_to_guardian' => 'nullable|string|max:50',
            'maritral_status' => 'nullable|string',
            'phone' => 'nullable|string|max:20',
            'alt_phone' => 'nullable|string|max:20',
            'email' => 'nullable|email|max:150',
            'is_injured' => 'nullable',
            'have_physical_diability' => 'nullable',
            'need_diapers' => 'nullable',
            'medical_eq_needed' => 'nullable|string',
            'is_lacting' => 'nullable',
            'is_pregnent' => 'nullable',
        ]);

        $dataEntry = Auth::user()->dataEntry;

        // تسجيل التغييرات
        $changes = [];
        $fields = [
            'name', 'national_id_no', 'gender', 'birthday',
            'relation_to_guardian', 'maritral_status', 'phone', 'alt_phone', 'email',
            'is_injured', 'have_physical_diability', 'need_diapers', 'medical_eq_needed',
            'is_lacting', 'is_pregnent'
        ];

        foreach ($fields as $field) {
            if ($request->has($field) && $member->$field != $request->$field) {
                $changes[$field] = [
                    'old' => $member->$field,
                    'new' => $request->$field,
                ];
            }
        }

        $member->update([
            ...$request->except(['_token', '_method', 'needs_medical']),
            'is_injured' => $request->is_injured ?? 0,
            'have_physical_diability' => $request->have_physical_diability ?? 0,
            'need_diapers' => $request->need_diapers ?? 0,
            'is_lacting' => $request->is_lacting ?? 0,
            'is_pregnent' => $request->is_pregnent ?? 0,
        ]);

        if (!empty($changes)) {
            ChangeLogService::log(
                $dataEntry->camp_id,
                'تعديل فرد',
                $member->id,
                'FamilyMember',
                $changes
            );
        }

        return redirect()->route('data-entry.families.members.show', [$family->id, $member->id])
            ->with('success', 'تم تعديل بيانات الفرد بنجاح');
    }

    public function destroy(Family $family, FamilyMember $member)
    {
        $dataEntry = Auth::user()->dataEntry;

        ChangeLogService::log(
            $dataEntry->camp_id,
            'حذف فرد',
            $member->id,
            'FamilyMember'
        );

        $member->delete();
        return redirect()->route('data-entry.families.members', $family->id)
            ->with('success', 'تم حذف الفرد بنجاح');
    }
}
