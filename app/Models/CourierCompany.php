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
        'is_commission_restricted',
        'commission_restricted_at',
        'total_commission_due',
    ];

    protected function casts(): array
    {
        return [
            'service_areas' => 'array',
            'pricing_structure' => 'array',
            'operating_hours' => 'array',
            'is_verified' => 'boolean',
            'is_featured' => 'boolean',
            'is_commission_restricted' => 'boolean',
            'rating' => 'decimal:2',
            'base_price' => 'decimal:2',
            'total_commission_due' => 'decimal:2',
            'commission_restricted_at' => 'datetime',
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

    public function commissions()
    {
        return $this->hasMany(CourierCompanyCommission::class);
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

    /**
     * Get unpaid commissions
     */
    public function getUnpaidCommissions()
    {
        return $this->commissions()->unpaid()->get();
    }

    /**
     * Get total unpaid commission amount
     */
    public function getTotalUnpaidCommission()
    {
        return $this->commissions()->unpaid()->sum('commission_amount');
    }

    /**
     * Get formatted total unpaid commission with currency
     */
    public function getFormattedTotalCommissionDueAttribute()
    {
        return $this->currency_symbol . ' ' . number_format($this->getTotalUnpaidCommission(), 0);
    }

    /**
     * Check if company should be restricted due to overdue payments
     */
    public function shouldBeRestricted()
    {
        $overdue_commissions = $this->commissions()
            ->where('status', 'pending')
            ->where('due_date', '<', now())
            ->count();
            
        return $overdue_commissions > 0;
    }

    /**
     * Get days until first unpaid commission is due
     */
    public function getDaysUntilRestriction()
    {
        $next_due = $this->commissions()
            ->pending()
            ->orderBy('due_date', 'asc')
            ->first();
            
        if (!$next_due) {
            return null;
        }
        
        // Days remaining until the earliest pending commission is due
        $days = now()->diffInDays($next_due->due_date, false);
        return max(0, $days);
    }

    /**
     * Apply commission restriction
     */
    public function applyCommissionRestriction()
    {
        if (!$this->is_commission_restricted) {
            $this->update([
                'is_commission_restricted' => true,
                'commission_restricted_at' => now(),
            ]);
            
            // Update overdue commissions status
            $this->commissions()
                ->where('status', 'pending')
                ->where('due_date', '<', now())
                ->update(['status' => 'overdue']);
        }
    }

    /**
     * Remove commission restriction
     */
    public function removeCommissionRestriction()
    {
        if ($this->is_commission_restricted) {
            $this->update([
                'is_commission_restricted' => false,
                'commission_restricted_at' => null,
            ]);
        }
    }

    /**
     * Check if company can receive new bookings
     */
    public function canReceiveBookings()
    {
        return !$this->is_commission_restricted;
    }

    /**
     * Get payment restriction message
     */
    public function getRestrictionMessage()
    {
        if (!$this->is_commission_restricted) {
            return null;
        }
        
        $amount = $this->formatted_total_commission_due;
        return "Please clear your outstanding payment of {$amount} to continue receiving bookings.";
    }

    /**
     * Update total commission due cache
     */
    public function updateCommissionDueCache()
    {
        $total = $this->getTotalUnpaidCommission();
        $this->update(['total_commission_due' => $total]);
    }
}
