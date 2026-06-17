<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AidDistribution extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'camp_id',
        'inventory_id',
        'for',
        'quantity',
        'status',
        'confirmed_at',
    ];

    public function inventory()
    {
        return $this->belongsTo(Inventory::class);
    }

    public function beneficiaries()
    {
        return $this->hasMany(AidBeneficiary::class, 'aid_distributions_id');
    }
}
