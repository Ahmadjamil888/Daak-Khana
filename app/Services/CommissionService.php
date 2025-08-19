<?php

namespace App\Services;

use App\Models\Booking;
use App\Models\CourierCompany;
use App\Models\CourierCompanyCommission;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class CommissionService
{
    const COMMISSION_RATE = 0.05; // 5%
    const PAYMENT_DUE_DAYS = 10;

    /**
     * Deduct commission from a booking
     */
    public function deductCommissionFromBooking(Booking $booking)
    {
        try {
            DB::beginTransaction();

            $commissionAmount = $booking->total_amount * self::COMMISSION_RATE;
            $dueDate = now()->addDays(self::PAYMENT_DUE_DAYS);

            // Create commission record
            $commission = CourierCompanyCommission::create([
                'courier_company_id' => $booking->courier_company_id,
                'booking_id' => $booking->id,
                'commission_amount' => $commissionAmount,
                'booking_amount' => $booking->total_amount,
                'status' => 'pending',
                'due_date' => $dueDate,
            ]);

            // Update company's total commission due
            $booking->courierCompany->updateCommissionDueCache();

            DB::commit();

            Log::info('Commission deducted from booking', [
                'booking_id' => $booking->id,
                'commission_id' => $commission->id,
                'commission_amount' => $commissionAmount,
                'due_date' => $dueDate,
            ]);

            return $commission;

        } catch (\Exception $e) {
            DB::rollback();
            Log::error('Failed to deduct commission from booking', [
                'booking_id' => $booking->id,
                'error' => $e->getMessage(),
            ]);
            throw $e;
        }
    }

    /**
     * Check and apply payment restrictions for overdue companies
     */
    public function checkAndApplyRestrictions()
    {
        $restrictedCount = 0;

        // Find companies with overdue commissions that aren't restricted yet
        $companies = CourierCompany::whereHas('commissions', function ($query) {
                $query->where('status', 'pending')
                      ->where('due_date', '<', now());
            })
            ->where('is_commission_restricted', false)
            ->get();

        foreach ($companies as $company) {
            $company->applyCommissionRestriction();
            $restrictedCount++;

            Log::info('Applied commission restriction to company', [
                'company_id' => $company->id,
                'company_name' => $company->company_name,
                'total_due' => $company->getTotalUnpaidCommission(),
            ]);
        }

        // Update overdue status for pending commissions
        CourierCompanyCommission::where('status', 'pending')
            ->where('due_date', '<', now())
            ->update(['status' => 'overdue']);

        return $restrictedCount;
    }

    /**
     * Remove restrictions for companies with no overdue payments
     */
    public function checkAndRemoveRestrictions()
    {
        $unrestrictedCount = 0;

        // Find restricted companies with no overdue commissions
        $companies = CourierCompany::where('is_commission_restricted', true)
            ->whereDoesntHave('commissions', function ($query) {
                $query->whereIn('status', ['pending', 'overdue']);
            })
            ->get();

        foreach ($companies as $company) {
            $company->removeCommissionRestriction();
            $company->updateCommissionDueCache();
            $unrestrictedCount++;

            Log::info('Removed commission restriction from company', [
                'company_id' => $company->id,
                'company_name' => $company->company_name,
            ]);
        }

        return $unrestrictedCount;
    }

    /**
     * Process payment for commissions
     */
    public function processCommissionPayment(CourierCompany $company, array $commissionIds, $stripePaymentIntentId = null, array $paymentMetadata = [])
    {
        try {
            DB::beginTransaction();

            $commissions = $company->commissions()
                ->whereIn('id', $commissionIds)
                ->unpaid()
                ->get();

            if ($commissions->isEmpty()) {
                throw new \Exception('No unpaid commissions found for payment');
            }

            $totalAmount = $commissions->sum('commission_amount');

            foreach ($commissions as $commission) {
                $commission->markAsPaid($stripePaymentIntentId, $paymentMetadata);
            }

            // Update company commission cache
            $company->updateCommissionDueCache();

            // Remove restriction if no more unpaid commissions
            if ($company->getTotalUnpaidCommission() == 0) {
                $company->removeCommissionRestriction();
            }

            DB::commit();

            Log::info('Commission payment processed', [
                'company_id' => $company->id,
                'commission_ids' => $commissionIds,
                'total_amount' => $totalAmount,
                'stripe_payment_intent_id' => $stripePaymentIntentId,
            ]);

            return [
                'success' => true,
                'total_amount' => $totalAmount,
                'commissions_paid' => $commissions->count(),
                'restriction_removed' => !$company->is_commission_restricted,
            ];

        } catch (\Exception $e) {
            DB::rollback();
            Log::error('Failed to process commission payment', [
                'company_id' => $company->id,
                'commission_ids' => $commissionIds,
                'error' => $e->getMessage(),
            ]);
            throw $e;
        }
    }

    /**
     * Get commission summary for a company
     */
    public function getCommissionSummary(CourierCompany $company)
    {
        $unpaidCommissions = $company->getUnpaidCommissions();
        $totalUnpaid = $company->getTotalUnpaidCommission();
        $daysUntilRestriction = $company->getDaysUntilRestriction();
        $isRestricted = $company->is_commission_restricted;

        $overdueCommissions = $unpaidCommissions->filter(function ($commission) {
            return $commission->isOverdue();
        });

        return [
            'total_unpaid' => $totalUnpaid,
            'formatted_total_unpaid' => $company->formatted_total_commission_due,
            'unpaid_count' => $unpaidCommissions->count(),
            'overdue_count' => $overdueCommissions->count(),
            'days_until_restriction' => $daysUntilRestriction,
            'is_restricted' => $isRestricted,
            'restriction_message' => $company->getRestrictionMessage(),
            'can_receive_bookings' => $company->canReceiveBookings(),
            'next_due_date' => $unpaidCommissions->sortBy('due_date')->first()?->due_date,
        ];
    }

    /**
     * Get detailed commission history for a company
     */
    public function getCommissionHistory(CourierCompany $company, $limit = 50)
    {
        return $company->commissions()
            ->with(['booking' => function ($query) {
                $query->select('id', 'booking_number', 'total_amount', 'created_at');
            }])
            ->orderBy('created_at', 'desc')
            ->limit($limit)
            ->get();
    }
}
