<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Service extends Pivot
{
    protected $table = 'services';

    public $timestamps = false;

    public $incrementing = true;

    public function serviceHistory(): BelongsTo
    {
        return $this->belongsTo(ServiceHistory::class);
    }

    public function work(): BelongsTo
    {
        return $this->belongsTo(Work::class);
    }
}
