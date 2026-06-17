<?php

namespace App\Http\Controllers;

use App\Models\Camp;
use App\Models\User;
use App\Models\Supporter;
use App\Models\Message;
use App\Models\RegistrationRequest;
use Illuminate\Http\Request;

class CampController extends Controller
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
        $data['section'] = 'camps';

        return view('dashboard.dashboard', $data);
    }

    public function show($id)
    {
        $data = $this->getSharedData();
        $data['selectedCamp'] = Camp::findOrFail($id);
        $data['section'] = 'camps';
        $data['subsection'] = 'show-camp';

        return view('dashboard.dashboard', $data);
    }

    public function create()
    {
        return view('dashboard.camps.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'governorate' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'families_count' => 'required|integer|min:0',
            'status' => 'required|in:active,inactive',
        ]);

        Camp::create($validated);

        return redirect()->route('camps.index')->with('success', 'تمت الإضافة');
    }

    public function edit($id)
    {
        $data = $this->getSharedData();
        $data['selectedCamp'] = Camp::findOrFail($id);
        $data['section'] = 'camps';
        $data['subsection'] = 'edit-camp';

        return view('dashboard.dashboard', $data);
    }

    public function update(Request $request, $id)
    {
        $camp = Camp::findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'governorate' => 'required|string|max:255',
            'families_count' => 'required|integer|min:0',
            'status' => 'required|in:active,inactive',
        ]);

        $camp->update($validated);

        return redirect()->route('camps.index')->with('success', 'تم تحديث المخيم بنجاح');
    }

    public function destroy(Camp $camp)
    {
        $camp->delete();

        return redirect()->route('camps.index')->with('success', 'تم الحذف');
    }
}