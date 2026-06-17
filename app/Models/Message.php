<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $table = 'messages';

    public $timestamps = false;

    protected $fillable = [
        'name',
        'email',
        'subject',
        'message',
        'status',
        'created_at',
    ];
}