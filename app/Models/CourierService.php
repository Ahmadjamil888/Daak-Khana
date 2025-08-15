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
}
