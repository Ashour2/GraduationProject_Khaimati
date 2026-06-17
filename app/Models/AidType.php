<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AidType extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'camp_id',
        'inventory_id',
        'name',
        'for',
        'gender',
        'min_age',
        'max_age',
        'isForInjured',
        'isForPhysicalDisability',
        'isForWhoNeedDiapers',
        'isForLacting',
        'isForPregnent',
    ];
}
