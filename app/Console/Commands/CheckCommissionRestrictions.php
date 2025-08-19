<?php

namespace App\Console\Commands;

use App\Services\CommissionService;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class CheckCommissionRestrictions extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'commission:check-restrictions
                          {--dry-run : Show what would be done without making changes}
                          {--force : Force apply restrictions even if not overdue}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Check and apply payment restrictions for courier companies with overdue commission payments';

    protected $commissionService;

    public function __construct(CommissionService $commissionService)
    {
        parent::__construct();
        $this->commissionService = $commissionService;
    }

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Checking commission restrictions...');
        
        $isDryRun = $this->option('dry-run');
        $force = $this->option('force');
        
        try {
            // Check and apply restrictions
            if (!$isDryRun) {
                $restrictedCount = $this->commissionService->checkAndApplyRestrictions();
                $this->info("Applied restrictions to {$restrictedCount} companies.");
            } else {
                $this->info('DRY RUN: Would apply restrictions to companies with overdue commissions.');
            }
            
            // Check and remove restrictions for companies that have paid
            if (!$isDryRun) {
                $unrestrictedCount = $this->commissionService->checkAndRemoveRestrictions();
                $this->info("Removed restrictions from {$unrestrictedCount} companies.");
            } else {
                $this->info('DRY RUN: Would remove restrictions from companies with no outstanding balances.');
            }
            
            // Show summary of current state
            $this->showSummary();
            
            Log::info('Commission restriction check completed', [
                'restricted_count' => $restrictedCount ?? 0,
                'unrestricted_count' => $unrestrictedCount ?? 0,
                'dry_run' => $isDryRun,
                'executed_by' => 'command',
            ]);
            
            $this->info('Commission restriction check completed successfully.');
            
        } catch (\Exception $e) {
            $this->error('Failed to check commission restrictions: ' . $e->getMessage());
            Log::error('Commission restriction check failed', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ]);
            return 1;
        }
        
        return 0;
    }
    
    /**
     * Show summary of current commission status
     */
    private function showSummary()
    {
        $companies = \App\Models\CourierCompany::with('commissions')
            ->whereHas('commissions')
            ->get();
        
        $restrictedCompanies = $companies->where('is_commission_restricted', true);
        $companiesWithOverdue = $companies->filter(function ($company) {
            return $company->shouldBeRestricted();
        });
        
        $totalUnpaidCommissions = \App\Models\CourierCompanyCommission::unpaid()->sum('commission_amount');
        $overdueCommissions = \App\Models\CourierCompanyCommission::overdue()->sum('commission_amount');
        
        $this->newLine();
        $this->info('=== Commission Summary ===');
        $this->line("Companies with commissions: {$companies->count()}");
        $this->line("Currently restricted companies: {$restrictedCompanies->count()}");
        $this->line("Companies with overdue payments: {$companiesWithOverdue->count()}");
        $this->line("Total unpaid commissions: Rs. " . number_format($totalUnpaidCommissions, 2));
        $this->line("Total overdue commissions: Rs. " . number_format($overdueCommissions, 2));
        
        if ($restrictedCompanies->count() > 0) {
            $this->newLine();
            $this->warn('Restricted Companies:');
            foreach ($restrictedCompanies as $company) {
                $this->line("- {$company->company_name} (Rs. " . number_format($company->getTotalUnpaidCommission(), 2) . ")");
            }
        }
        
        if ($companiesWithOverdue->count() > 0 && $companiesWithOverdue->count() > $restrictedCompanies->count()) {
            $this->newLine();
            $this->warn('Companies with overdue payments (not yet restricted):');
            $notRestricted = $companiesWithOverdue->where('is_commission_restricted', false);
            foreach ($notRestricted as $company) {
                $this->line("- {$company->company_name} (Rs. " . number_format($company->getTotalUnpaidCommission(), 2) . ")");
            }
        }
    }
}
