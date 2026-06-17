<?php

namespace App\Http\Controllers\Representative;

use App\Http\Controllers\Controller;
use App\Models\Supporter;
use App\Models\CampSupporter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class SupporterController extends Controller
{
    private function getCampId()
    {
        return Auth::user()->representative->camp_id;
    }

    public function index()
    {
        $campId = $this->getCampId();

        $campSupporters = Supporter::whereHas('camps', function($q) use ($campId) {
            $q->where('camps.id', $campId);
        })->get();

        $otherSupporters = Supporter::whereDoesntHave('camps', function($q) use ($campId) {
            $q->where('camps.id', $campId);
        })->get();

        return view('representative.supporters.index', compact('campSupporters', 'otherSupporters'));
    }

    public function create()
    {
        return view('representative.supporters.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:150',
            'phone' => 'nullable|string|max:20',
            'email' => 'nullable|email',
            'website_link' => 'nullable|string',
            'aid_sector' => 'nullable|string',
            'about' => 'nullable|string',
            'terms' => 'nullable|string',
            'logo' => 'nullable|image|max:2048',
        ]);

        $logoPath = null;
        if ($request->hasFile('logo')) {
            $logoPath = $request->file('logo')->store('supporters', 'public');
        }

        $supporter = Supporter::create([
            ...$request->except(['_token', 'logo']),
            'logo_path' => $logoPath,
            'added_by' => Auth::user()->name,
        ]);

        CampSupporter::create([
            'camp_id' => $this->getCampId(),
            'supporters_id' => $supporter->id,
        ]);

        return redirect()->route('representative.supporters.index')
            ->with('success', 'تم إضافة الداعم بنجاح');
    }

    public function show(Supporter $supporter)
    {
        return view('representative.supporters.show', compact('supporter'));
    }

    public function edit(Supporter $supporter)
    {
        return view('representative.supporters.edit', compact('supporter'));
    }

    public function update(Request $request, Supporter $supporter)
    {
        $request->validate([
            'name' => 'required|string|max:150',
            'phone' => 'nullable|string|max:20',
            'email' => 'nullable|email',
            'website_link' => 'nullable|string',
            'aid_sector' => 'nullable|string',
            'about' => 'nullable|string',
            'terms' => 'nullable|string',
        ]);

        $supporter->update($request->except(['_token', '_method', 'logo']));

        return redirect()->route('representative.supporters.index')
            ->with('success', 'تم تعديل بيانات الداعم بنجاح');
    }

    public function destroy(Supporter $supporter)
    {
        CampSupporter::where('camp_id', $this->getCampId())
            ->where('supporters_id', $supporter->id)
            ->delete();

        return redirect()->route('representative.supporters.index')
            ->with('success', 'تم حذف الداعم بنجاح');
    }

    public function addToCamp(Supporter $supporter)
    {
        CampSupporter::firstOrCreate([
            'camp_id' => $this->getCampId(),
            'supporters_id' => $supporter->id,
        ]);

        return redirect()->route('representative.supporters.index')
            ->with('success', 'تم إضافة الداعم للمخيم بنجاح');
    }
}
