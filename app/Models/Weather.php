<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Weather extends Model
{
    use HasFactory;

    protected $casts = [
        'time_of_data_calculation' => 'datetime'
    ];

    public function city(): BelongsTo
    {
        return $this->belongsTo(City::class);
    }
}
