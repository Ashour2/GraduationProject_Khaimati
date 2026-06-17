<?php

namespace App\Http\Controllers;

use App\Models\Supporter;
use App\Models\User;
use Illuminate\Http\Request;

class SupporterController extends Controller
{
    use Traits\DashboardData;

    public function index()
    {
        return view('dashboard.dashboard', array_merge(
            $this->dashboardData(),
            ['section' => 'institutionsSection']
        ));
    }

    public function create()
    {
        return view('dashboard.dashboard', array_merge(
            $this->dashboardData(),
            [
                'section' => 'institutionsSection',
                'subsection' => 'add-supporter',
            ]
        ));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:150',
            'phone' => 'nullable|string|max:20',
            'email' => 'nullable|email|max:150',
            'website_link' => 'nullable|string|max:150',
            'aid_sector' => 'nullable|string|max:100',
            'about' => 'nullable|string|max:1000',
            'terms' => 'nullable|string|max:1000',
            'logo' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $logoPath = null;

        if ($request->hasFile('logo')) {
            $logoPath = $request->file('logo')->store('supporters/logos', 'public');
        }

        Supporter::create([
            'name' => $validated['name'],
            'phone' => $validated['phone'] ?? null,
            'email' => $validated['email'] ?? null,
            'website_link' => $validated['website_link'] ?? null,
            'aid_sector' => $validated['aid_sector'] ?? null,
            'about' => $validated['about'] ?? null,
            'terms' => $validated['terms'] ?? null,
            'logo_path' => $logoPath,
            'added_by' => User::where('role', 'admin')->first()?->name ?? 'admin',
        ]);

        return redirect()->route('supporters.index')->with('success', 'تمت إضافة المؤسسة بنجاح');
    }

    public function edit(Supporter $supporter)
    {
        return view('dashboard.dashboard', array_merge(
            $this->dashboardData(),
            [
                'section' => 'institutionsSection',
                'subsection' => 'edit-supporter',
                'selectedSupporter' => $supporter,
            ]
        ));
    }

    public function update(Request $request, Supporter $supporter)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:150',
            'phone' => 'nullable|string|max:20',
            'email' => 'nullable|email|max:150',
            'website_link' => 'nullable|string|max:150',
            'aid_sector' => 'nullable|string|max:100',
            'about' => 'nullable|string|max:1000',
            'terms' => 'nullable|string|max:1000',
            'logo' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        if ($request->hasFile('logo')) {
            $validated['logo_path'] = $request->file('logo')->store('supporters/logos', 'public');
        }

        unset($validated['logo']);

        $supporter->update($validated);

        return redirect()->route('supporters.index')->with('success', 'تم تعديل المؤسسة بنجاح');
    }

    public function show(Supporter $supporter)
    {
        return view('dashboard.dashboard', array_merge(
            $this->dashboardData(),
            [
                'section' => 'institutionsSection',
                'subsection' => 'show-supporter',
                'selectedSupporter' => $supporter,
            ]
        ));
    }

    public function destroy(Supporter $supporter)
    {
        $supporter->delete();

        return redirect()->route('supporters.index')
            ->with('success', 'تم حذف المؤسسة بنجاح');
    }
}
