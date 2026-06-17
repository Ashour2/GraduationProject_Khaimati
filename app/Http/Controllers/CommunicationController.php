<?php

namespace App\Http\Controllers;

use App\Models\Communication;
use Illuminate\Http\Request;

class CommunicationController extends Controller
{
    use Traits\DashboardData;

    public function edit()
    {
        return view('dashboard.dashboard', array_merge(
            $this->dashboardData(),
            ['section' => 'contact']
        ));
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'email' => 'nullable|string|max:255',
            'whatsapp' => 'nullable|string|max:255',
            'linkedin' => 'nullable|string|max:255',
            'phone' => 'nullable|string|max:255',
            'facebook' => 'nullable|string|max:255',
        ]);

        foreach ($validated as $name => $value) {
            Communication::updateOrCreate(
                ['name' => $name],
                ['value' => $value]
            );
        }

        return redirect()->route('communications.edit')
            ->with('success', 'تم تحديث بيانات التواصل بنجاح');
    }
}