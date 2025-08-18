<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CourierService extends Model
{
    use HasFactory;

    protected $fillable = [
        'courier_company_id',
        'service_name',
        'description',
        'service_type',
        'price',
        'currency',
        'delivery_time',
        'max_weight',
        'package_types',
        'is_active',
    ];

    protected function casts(): array
    {
        return [
            'package_types' => 'array',
            'is_active' => 'boolean',
            'price' => 'decimal:2',
            'max_weight' => 'decimal:2',
        ];
    }

    public function courierCompany()
    {
        return $this->belongsTo(CourierCompany::class);
    }

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }

    /**
     * Get formatted price with currency
     */
    public function getFormattedPriceAttribute()
    {
        $currency = $this->currency ?? $this->courierCompany->currency ?? 'PKR';
        return $currency . ' ' . number_format($this->price, 0);
    }

    /**
     * Get currency symbol
     */
    public function getCurrencySymbolAttribute()
    {
        $currency = $this->currency ?? $this->courierCompany->currency ?? 'PKR';
        $symbols = [
            'PKR' => 'Rs.',
            'USD' => '$',
            'EUR' => '€',
            'GBP' => '£',
        ];
        
        return $symbols[$currency] ?? $currency;
    }

    /**
     * Get effective currency (fallback to company currency)
     */
    public function getEffectiveCurrencyAttribute()
    {
        return $this->currency ?? $this->courierCompany->currency ?? 'PKR';
    }
}
