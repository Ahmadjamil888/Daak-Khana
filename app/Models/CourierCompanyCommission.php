<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class CourierCompanyCommission extends Model
{
    use HasFactory;

    protected $fillable = [
        'courier_company_id',
        'booking_id',
        'commission_amount',
        'booking_amount',
        'status',
        'due_date',
        'paid_at',
        'stripe_payment_intent_id',
        'payment_metadata',
    ];

    protected function casts(): array
    {
        return [
            'commission_amount' => 'decimal:2',
            'booking_amount' => 'decimal:2',
            'due_date' => 'datetime',
            'paid_at' => 'datetime',
            'payment_metadata' => 'array',
        ];
    }

    public function courierCompany()
    {
        return $this->belongsTo(CourierCompany::class);
    }

    public function booking()
    {
        return $this->belongsTo(Booking::class);
    }

    /**
     * Check if commission is overdue
     */
    public function isOverdue()
    {
        return $this->status === 'pending' && $this->due_date->lt(now());
    }

    /**
     * Get days remaining until due
     */
    public function getDaysRemainingAttribute()
    {
        if ($this->status !== 'pending') {
            return null;
        }
        
        return max(0, $this->due_date->diffInDays(now(), false));
    }

    /**
     * Get days overdue
     */
    public function getDaysOverdueAttribute()
    {
        if ($this->status !== 'pending' || !$this->isOverdue()) {
            return 0;
        }
        
        return $this->due_date->diffInDays(now());
    }

    /**
     * Mark commission as paid
     */
    public function markAsPaid($stripePaymentIntentId = null, $paymentMetadata = null)
    {
        $this->update([
            'status' => 'paid',
            'paid_at' => now(),
            'stripe_payment_intent_id' => $stripePaymentIntentId,
            'payment_metadata' => $paymentMetadata,
        ]);
    }

    /**
     * Update status to overdue if past due date
     */
    public function checkAndUpdateOverdue()
    {
        if ($this->status === 'pending' && $this->isOverdue()) {
            $this->update(['status' => 'overdue']);
        }
    }

    /**
     * Scope for pending commissions
     */
    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }

    /**
     * Scope for overdue commissions
     */
    public function scopeOverdue($query)
    {
        return $query->where('status', 'overdue')
                    ->orWhere(function($q) {
                        $q->where('status', 'pending')
                          ->where('due_date', '<', now());
                    });
    }

    /**
     * Scope for unpaid commissions (pending or overdue)
     */
    public function scopeUnpaid($query)
    {
        return $query->whereIn('status', ['pending', 'overdue']);
    }
}
