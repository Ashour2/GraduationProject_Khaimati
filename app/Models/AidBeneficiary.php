<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AidBeneficiary extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'aid_distributions_id',
        'family_members_id',
        'families_id',
        'family_id',
        'member_id',
        'status',
    ];

    public function family()
    {
        return $this->belongsTo(Family::class, 'families_id');
    }

    public function member()
    {
        return $this->belongsTo(FamilyMember::class, 'family_members_id');
    }
}
