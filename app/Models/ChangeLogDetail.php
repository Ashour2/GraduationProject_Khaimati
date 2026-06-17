<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ChangeLogDetail extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'change_logs_id',
        'field_name',
        'old_value',
        'new_value',
    ];
}
