<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    protected $fillable = [
        'booking_number',
        'customer_id',
        'courier_company_id',
        'courier_service_id',
        'pickup_address',
        'delivery_address',
        'package_details',
        'total_amount',
        'status',
        'pickup_date',
        'delivery_date',
        'special_instructions',
        'tracking_updates',
        'is_pro_booking',
        'assigned_courier_id',
        'real_time_tracking_enabled',
        'pro_features',
        'pro_fee',
    ];

    protected function casts(): array
    {
        return [
            'package_details' => 'array',
            'tracking_updates' => 'array',
            'total_amount' => 'decimal:2',
            'pickup_date' => 'datetime',
            'delivery_date' => 'datetime',
            'is_pro_booking' => 'boolean',
            'real_time_tracking_enabled' => 'boolean',
            'pro_features' => 'array',
            'pro_fee' => 'decimal:2',
        ];
    }

    public function customer()
    {
        return $this->belongsTo(User::class, 'customer_id');
    }

    public function courierCompany()
    {
        return $this->belongsTo(CourierCompany::class);
    }

    public function courierService()
    {
        return $this->belongsTo(CourierService::class);
    }

    public function assignedCourier()
    {
        return $this->belongsTo(User::class, 'assigned_courier_id');
    }

    public function messages()
    {
        return $this->hasMany(Message::class);
    }

    public function realTimeLocations()
    {
        return $this->hasMany(RealTimeLocation::class);
    }

    public function latestLocation()
    {
        return $this->hasOne(RealTimeLocation::class)->latest();
    }
}
