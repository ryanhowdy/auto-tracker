<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Vehicle extends Model
{
    protected $fillable = [
        'name',
        'type',
        'manufacturer',
        'model',
        'year',
        'license',
        'vin',
        'notes',
        'status',
    ];

    public function miles(): HasMany
    {
        return $this->hasMany(Mile::class);
    }

    public function serviceHistories(): HasMany
    {
        return $this->hasMany(ServiceHistory::class);
    }
}
