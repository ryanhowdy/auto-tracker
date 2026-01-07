<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ServiceHistory extends Model
{
    protected $table = 'service_history';

    protected $fillable = [
        'vehicle_id',
        'place_id',
        'mile_id',
        'total',
        'notes',
    ];

    public function vehicle(): BelongsTo
    {
        return $this->belongsTo(Vehicle::class);
    }

    public function place(): BelongsTo
    {
        return $this->belongsTo(Place::class);
    }

    public function mile(): BelongsTo
    {
        return $this->belongsTo(Mile::class);
    }

    public function services(): HasMany
    {
        return $this->hasMany(Service::class);
    }
}
