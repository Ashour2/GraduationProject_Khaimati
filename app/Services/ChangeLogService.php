<?php

namespace App\Services;

use App\Models\ChangeLog;
use App\Models\ChangeLogDetail;
use Illuminate\Support\Facades\Auth;

class ChangeLogService
{
    public static function log(
        int $campId,
        string $operationType,
        int $targetId,
        string $targetType,
        array $changes = []
    ) {
        $log = ChangeLog::create([
            'camp_id' => $campId,
            'user_id' => Auth::id(),
            'user_role' => Auth::user()->role,
            'operation_type' => $operationType,
            'target_id' => $targetId,
            'target_type' => $targetType,
        ]);

        foreach ($changes as $field => $values) {
            ChangeLogDetail::create([
                'change_logs_id' => $log->id,
                'field_name' => $field,
                'old_value' => $values['old'] ?? null,
                'new_value' => $values['new'] ?? null,
            ]);
        }
    }
}
