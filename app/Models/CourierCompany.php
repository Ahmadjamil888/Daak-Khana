<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CourierCompany extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'company_name',
        'description',
        'ai_generated_description',
        'logo',
        'service_areas',
        'rating',
        'total_reviews',
        'base_price',
        'currency',
        'pricing_structure',
        'is_verified',
        'is_featured',
        'operating_hours',
        'license_number',
        'insurance_details',
    ];

    protected function casts(): array
    {
        return [
            'service_areas' => 'array',
            'pricing_structure' => 'array',
            'operating_hours' => 'array',
            'is_verified' => 'boolean',
            'is_featured' => 'boolean',
            'rating' => 'decimal:2',
            'base_price' => 'decimal:2',
        ];
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function services()
    {
        return $this->hasMany(CourierService::class);
    }

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }

    /**
     * Get formatted base price with currency
     */
    public function getFormattedBasePriceAttribute()
    {
        return $this->currency . ' ' . number_format($this->base_price, 0);
    }

    /**
     * Get currency symbol
     */
    public function getCurrencySymbolAttribute()
    {
        $symbols = [
            'PKR' => 'Rs.',
            'USD' => '$',
            'EUR' => '€',
            'GBP' => '£',
        ];
        
        return $symbols[$this->currency] ?? $this->currency;
    }
}
