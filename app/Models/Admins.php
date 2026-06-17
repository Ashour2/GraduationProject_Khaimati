<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Admins extends Model
{
    protected $fillable = [
        'name','email','password','national_id_no'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
