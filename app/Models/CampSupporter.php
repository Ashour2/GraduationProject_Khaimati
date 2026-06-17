<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CampSupporter extends Model
{
    protected $table = 'camps_supporters';

    protected $fillable = [
        'camp_id',
        'supporters_id',
    ];
}
