<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FamilyMember extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'families_id',
        'relation_to_guardian',
        'gender',
        'name',
        'national_id_no',
        'birthday',
        'maritral_status',
        'phone',
        'alt_phone',
        'email',
        'is_injured',
        'have_physical_diability',
        'need_diapers',
        'medical_eq_needed',
        'is_lacting',
        'is_pregnent',
    ];

    public function family()
    {
        return $this->belongsTo(Family::class, 'families_id');
    }

}
