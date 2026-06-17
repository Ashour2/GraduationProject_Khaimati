<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DataEntry extends Model
{

    public $timestamps = false;

    protected $fillable = [
        'user_id',
        'camp_id',
        'name',
        'email',
        'phone',
        'password',
        'status',
        'national_id_no',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function camp()
    {
        return $this->belongsTo(Camp::class);
    }
}
