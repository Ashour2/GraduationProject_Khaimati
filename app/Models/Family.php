<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Family extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'camp_id',
        'guardian_name',
        'gender',
        'national_id_no',
        'birthday',
        'marital_status',
        'governorate',
        'place_of_residence',
        'phone',
        'alt_phone',
        'email',
        'is_injured',
        'have_physical_disbility',
        'need_diapers',
        'medical_eq_needed',
        'is_lacting',
        'is_pregnant',
    ];

    public function members()
    {
        return $this->hasMany(FamilyMember::class, 'families_id');
    }

    public function camp()
    {
        return $this->belongsTo(Camp::class);
    }
}
