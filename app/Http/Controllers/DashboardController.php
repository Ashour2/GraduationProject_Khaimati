<?php

namespace App\Http\Controllers;

use App\Models\Camp;
use App\Models\User;
use App\Models\Supporter;
use App\Models\Message;
use App\Models\RegistrationRequest;

class DashboardController extends Controller
{
    private function dashboardData()
    {
        return [
            'campsCount' => Camp::count(),
            'adminsCount' => User::where('role', 'admin')->count(),
            'representativesCount' => User::where('role', 'representative')->count(),
            'dataEntriesCount' => User::where('role', 'data_entry')->count(),
            'supportersCount' => Supporter::count(),
            'messagesCount' => Message::count(),

            'messages' => Message::latest('created_at')->get(),
            'camps' => Camp::all(),
            'requests' => RegistrationRequest::latest('created_at')->get(),
        ];
    }

    public function index()
    {
        return view('dashboard.dashboard', array_merge(
            $this->dashboardData(),
            ['section' => 'dashboard']
        ));
    }

    public function showRequests()
    {
        return view('dashboard.dashboard', array_merge(
            $this->dashboardData(),
            ['section' => 'requests']
        ));
    }

    public function usersIndex()
    {
        $users = User::all();

        return view('dashboard.dashboard', array_merge(
            $this->dashboardData(),
            [
                'section' => 'users',
                'users' => $users,
            ]
        ));
    }

    public function messagesIndex()
    {
        return view('dashboard.dashboard', array_merge(
            $this->dashboardData(),
            ['section' => 'messages']
        ));
    }

    public function showMessage($id)
    {
        $selectedMessage = Message::findOrFail($id);

        if ($selectedMessage->status === 'new') {
            $selectedMessage->status = 'read';
            $selectedMessage->save();
        }

        return view('dashboard.dashboard', array_merge(
            $this->dashboardData(),
            [
                'section' => 'message-details',
                'selectedMessage' => $selectedMessage,
            ]
        ));
    }

    public function deleteMessage($id)
    {
        $message = Message::findOrFail($id);
        $message->delete();

        return redirect()->route('dashboard')->with('success', 'تم حذف الرسالة بنجاح');
    }
}
