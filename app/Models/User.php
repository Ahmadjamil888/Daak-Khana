<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'user_type',
        'phone',
        'address',
        'is_active',
        'is_pro',
        'pro_expires_at',
        'stripe_customer_id',
        'wallet_balance',
        'pro_features',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'is_active' => 'boolean',
            'is_pro' => 'boolean',
            'pro_expires_at' => 'datetime',
            'wallet_balance' => 'decimal:2',
            'pro_features' => 'array',
        ];
    }

    public function courierCompany()
    {
        return $this->hasOne(CourierCompany::class);
    }

    public function bookings()
    {
        return $this->hasMany(Booking::class, 'customer_id');
    }

    public function isCustomer()
    {
        return $this->user_type === 'customer';
    }

    public function isCourier()
    {
        return $this->user_type === 'courier';
    }

    public function subscriptions()
    {
        return $this->hasMany(Subscription::class);
    }

    public function sentMessages()
    {
        return $this->hasMany(Message::class, 'sender_id');
    }

    public function receivedMessages()
    {
        return $this->hasMany(Message::class, 'receiver_id');
    }

    public function realTimeLocations()
    {
        return $this->hasMany(RealTimeLocation::class, 'courier_id');
    }

    public function isProActive()
    {
        return $this->is_pro && ($this->pro_expires_at === null || $this->pro_expires_at > now());
    }

    public function hasProFeature($feature)
    {
        if (!$this->isProActive()) {
            return false;
        }

        $features = $this->pro_features ?? [];
        return in_array($feature, $features);
    }

    public function getProFeaturesForUserType()
    {
        if ($this->isCustomer()) {
            return [
                'real_time_tracking',
                'priority_support',
                'email_notifications',
                'real_time_messaging',
                'advanced_analytics'
            ];
        } else {
            return [
                'ai_profile_generation',
                'ai_order_handling',
                'advanced_dashboard',
                'priority_listings'
            ];
        }
    }
}
