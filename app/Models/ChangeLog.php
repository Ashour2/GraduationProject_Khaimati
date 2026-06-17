<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ChangeLog extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'camp_id',
        'user_id',
        'user_role',
        'operation_type',
        'target_id',
        'target_type',
    ];

    public function details()
    {
        return $this->hasMany(ChangeLogDetail::class, 'change_logs_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
