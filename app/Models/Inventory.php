<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Inventory extends Model
{
    public $timestamps = false;

    protected $table = 'inventory';

    protected $fillable = [
        'camp_id',
        'supporters_id',
        'org_id',
        'type_id',
        'package_name',
        'description',
        'recived_q',
        'distributed_q',
    ];

    public function camp()
    {
        return $this->belongsTo(Camp::class);
    }

    public function supporter()
    {
        return $this->belongsTo(Supporter::class, 'supporters_id');
    }
}
