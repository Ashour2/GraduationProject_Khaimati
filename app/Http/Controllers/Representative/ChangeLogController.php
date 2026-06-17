<?php

namespace App\Http\Controllers\Representative;

use App\Http\Controllers\Controller;
use App\Models\ChangeLog;
use Illuminate\Support\Facades\Auth;

class ChangeLogController extends Controller
{
    public function index()
    {
        $campId = Auth::user()->representative->camp_id;
        $logs = ChangeLog::where('camp_id', $campId)
            ->with(['details', 'user'])
            ->orderBy('created_at', 'desc')
            ->get();
        return view('representative.change-logs.index', compact('logs'));
    }

    public function show(ChangeLog $changeLog)
    {
        $campId = Auth::user()->representative->camp_id;

        if ($changeLog->camp_id !== $campId) {
            abort(403, 'غير مصرح لك بعرض هذا السجل');
        }

        $changeLog->load(['details', 'user']);
        return view('representative.change-logs.show', compact('changeLog'));
    }
}
