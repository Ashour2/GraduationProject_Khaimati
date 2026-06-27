<?php

namespace App\Http\Controllers\Traits;

use App\Models\Camp;
use App\Models\User;
use App\Models\Supporter;
use App\Models\Message;
use App\Models\RegistrationRequest;
use App\Models\Communication;

trait DashboardData
{
    public function dashboardData()
    {
        return [
            'users' => User::with(['representative.camp', 'dataEntry.camp', 'adminProfile.user'])->get(),
            'campsCount' => Camp::count(),
            'adminsCount' => User::where('role', 'admin')->count(),
            'representativesCount' => User::where('role', 'representative')->count(),
            'dataEntriesCount' => User::where('role', 'data_entry')->count(),
            'supportersCount' => Supporter::count(),
            'messagesCount' => Message::count(),
            'supporters' => Supporter::latest()->get(),
            'communications' => Communication::pluck('value', 'name'),
            'messages' => Message::latest('created_at')->get(),
            'camps' => Camp::with('representative')->get(),
            'requests' => RegistrationRequest::latest('created_at')->get(),
            'representative' => null,
            'reportCamps' => collect(),
            'reportCamp' => null,
        ];
    }
}
