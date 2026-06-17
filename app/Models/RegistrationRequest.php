<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RegistrationRequest extends Model
{
    protected $table = 'registration_requests';

    public $timestamps = false;

    protected $fillable = [
        'camp_name',
        'governorate',
        'location',
        'families_count',
        'rep_name',
        'gender',
        'national_id_no',
        'email',
        'phone',
        'national_id_img_path',
        'personal_img_path',
        'verification_img_path',
        'status',
    ];
}