<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Representative extends Model
{

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function camp()
    {
        return $this->belongsTo(Camp::class);
    }

    protected $fillable = [
        "user_id",
        'camp_id',
        'name',
        'email',
        'password',
        'phone',
        'gender',
        'national_id_no',
        'governorate',
        'national_id_img_path',
        'personal_img_path',
        'verification_img_path',
        'status',
    ];

    public $timestamps = false;
}
