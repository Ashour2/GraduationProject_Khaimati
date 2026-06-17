<?php

namespace App\Http\Controllers\DataEntry;

use App\Http\Controllers\Controller;
use App\Models\Family;
use App\Services\ChangeLogService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FamilyController extends Controller
{
    public function index()
    {
        $dataEntry = Auth::user()->dataEntry;

        if (!$dataEntry) {
            abort(403, 'هذا الحساب غير مرتبط بمخيم');
        }

        $families = Family::where('camp_id', $dataEntry->camp_id)->get();
        return view('data-entry.families.index', compact('families'));
    }

    public function create()
    {
        return view('data-entry.families.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'guardian_name' => 'required|string|max:100',
            'national_id_no' => 'nullable|string|max:20',
            'gender' => 'nullable|string',
            'marital_status' => 'nullable|string',
            'governorate' => 'nullable|string',
            'place_of_residence' => 'nullable|string',
            'phone' => 'nullable|string|max:20',
            'alt_phone' => 'nullable|string|max:20',
            'email' => 'nullable|email',
            'is_injured' => 'nullable',
            'have_physical_disbility' => 'nullable',
            'need_diapers' => 'nullable',
            'medical_eq_needed' => 'nullable|string',
            'is_lacting' => 'nullable',
            'is_pregnant' => 'nullable',
        ]);

        $dataEntry = Auth::user()->dataEntry;

        if (!$dataEntry) {
            abort(403, 'هذا الحساب غير مرتبط بمخيم');
        }

        $family = Family::create([
            ...$request->except(['_token', 'needs_medical']),
            'camp_id' => $dataEntry->camp_id,
            'is_injured' => $request->is_injured ?? 0,
            'have_physical_disbility' => $request->have_physical_disbility ?? 0,
            'need_diapers' => $request->need_diapers ?? 0,
            'is_lacting' => $request->is_lacting ?? 0,
            'is_pregnant' => $request->is_pregnant ?? 0,
        ]);

        ChangeLogService::log(
            $dataEntry->camp_id,
            'إضافة عائلة',
            $family->id,
            'Family'
        );

        return redirect()->route('data-entry.families.create')
            ->with('success', 'تم حفظ العائلة بنجاح')
            ->with('new_family_id', $family->id);
    }

    public function show(Family $family)
    {
        $members = $family->members;
        return view('data-entry.families.show', compact('family', 'members'));
    }

    public function edit(Family $family)
    {
        return view('data-entry.families.edit', compact('family'));
    }

    public function update(Request $request, Family $family)
    {
        $request->validate([
            'guardian_name' => 'required|string|max:100',
            'national_id_no' => 'nullable|string|max:20',
            'gender' => 'nullable|string',
            'marital_status' => 'nullable|string',
            'governorate' => 'nullable|string',
            'place_of_residence' => 'nullable|string',
            'phone' => 'nullable|string|max:20',
            'alt_phone' => 'nullable|string|max:20',
            'email' => 'nullable|email',
            'is_injured' => 'nullable',
            'have_physical_disbility' => 'nullable',
            'need_diapers' => 'nullable',
            'medical_eq_needed' => 'nullable|string',
            'is_lacting' => 'nullable',
            'is_pregnant' => 'nullable',
        ]);

        $dataEntry = Auth::user()->dataEntry;

        // تسجيل التغييرات
        $changes = [];
        $fields = [
            'guardian_name', 'national_id_no', 'gender', 'marital_status',
            'governorate', 'place_of_residence', 'phone', 'alt_phone', 'email',
            'is_injured', 'have_physical_disbility', 'need_diapers',
            'medical_eq_needed', 'is_lacting', 'is_pregnant'
        ];

        foreach ($fields as $field) {
            if ($request->has($field) && $family->$field != $request->$field) {
                $changes[$field] = [
                    'old' => $family->$field,
                    'new' => $request->$field,
                ];
            }
        }

        $family->update([
            ...$request->except(['_token', '_method', 'needs_medical']),
            'is_injured' => $request->is_injured ?? 0,
            'have_physical_disbility' => $request->have_physical_disbility ?? 0,
            'need_diapers' => $request->need_diapers ?? 0,
            'is_lacting' => $request->is_lacting ?? 0,
            'is_pregnant' => $request->is_pregnant ?? 0,
        ]);

        if (!empty($changes)) {
            ChangeLogService::log(
                $dataEntry->camp_id,
                'تعديل عائلة',
                $family->id,
                'Family',
                $changes
            );
        }

        return redirect()->route('data-entry.families.show', $family->id)
            ->with('success', 'تم تعديل بيانات العائلة بنجاح');
    }

    public function destroy(Family $family)
    {
        $dataEntry = Auth::user()->dataEntry;

        ChangeLogService::log(
            $dataEntry->camp_id,
            'حذف عائلة',
            $family->id,
            'Family'
        );

        $family->delete();
        return redirect()->route('data-entry.families.index')
            ->with('success', 'تم حذف العائلة بنجاح');
    }
}
