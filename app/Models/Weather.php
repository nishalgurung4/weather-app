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

    protected $appends = ['unit_description'];

    const TYPE_DEFAULT = '0';
    const TYPE_METRIC = '1';
    const TYPE_IMPERIAL = '2';

    public function city(): BelongsTo
    {
        return $this->belongsTo(City::class);
    }

    /**
     * Get unit description
     * @return string
     */
    public function getUnitDescriptionAttribute()
    {
        return  match ($this->unit) {
            static::TYPE_DEFAULT => 'Kelvin, m/sec',
            static::TYPE_METRIC => 'Celsius, m/sec',
            static::TYPE_IMPERIAL => 'Fahrenheit, miles/hour',
            default => '',
        };
    }
}
