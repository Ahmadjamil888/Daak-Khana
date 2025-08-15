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
}
