<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\CourierCompany;
use App\Models\CourierService;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class TestCompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create a test customer user
        User::firstOrCreate(
            ['email' => 'customer@example.com'],
            [
                'name' => 'Test Customer',
                'password' => Hash::make('password'),
                'user_type' => 'customer',
                'phone' => '+1-555-9999',
                'address' => '123 Customer Street, Residential Area',
            ]
        );

        // Create a test courier user
        $courierUser = User::firstOrCreate(
            ['email' => 'courier@example.com'],
            [
                'name' => 'Test Courier Company',
                'password' => Hash::make('password'),
                'user_type' => 'courier',
                'phone' => '+1-555-1234',
                'address' => '456 Business Ave, Commercial District',
            ]
        );

        // Create a test courier company
        $company = CourierCompany::firstOrCreate(
            ['user_id' => $courierUser->id],
            [
                'company_name' => 'Test Express Delivery',
                'description' => 'Professional courier service providing fast and reliable delivery solutions for businesses and individuals. We specialize in same-day delivery and express shipping.',
                'ai_generated_description' => 'Test Express Delivery offers comprehensive courier services with a focus on speed, reliability, and customer satisfaction.',
                'service_areas' => ['Downtown', 'Uptown', 'Business District', 'Residential Areas'],
                'rating' => 4.5,
                'total_reviews' => 25,
                'base_price' => 15.00,
                'pricing_structure' => [
                    'base_rate' => 15.00,
                    'per_km' => 0.75,
                    'per_kg' => 0.30,
                ],
                'is_verified' => true,
                'is_featured' => false,
                'operating_hours' => [
                    'monday' => '8:00-18:00',
                    'tuesday' => '8:00-18:00',
                    'wednesday' => '8:00-18:00',
                    'thursday' => '8:00-18:00',
                    'friday' => '8:00-18:00',
                    'saturday' => '9:00-15:00',
                    'sunday' => 'closed',
                ],
                'license_number' => 'TED-2024-001',
                'insurance_details' => 'Fully insured up to $5,000 per package',
            ]
        );

        // Create test services
        CourierService::firstOrCreate(
            [
                'courier_company_id' => $company->id,
                'service_name' => 'Same Day Express'
            ],
            [
                'description' => 'Fast same-day delivery within 4-6 hours',
                'service_type' => 'same_day',
                'price' => 25.00,
                'delivery_time' => '4-6 hours',
                'max_weight' => 20.0,
                'package_types' => ['documents', 'small_packages', 'electronics'],
                'is_active' => true,
            ]
        );

        CourierService::firstOrCreate(
            [
                'courier_company_id' => $company->id,
                'service_name' => 'Standard Delivery'
            ],
            [
                'description' => 'Reliable next-day delivery service',
                'service_type' => 'standard',
                'price' => 15.00,
                'delivery_time' => '1-2 business days',
                'max_weight' => 50.0,
                'package_types' => ['documents', 'packages', 'clothing', 'books'],
                'is_active' => true,
            ]
        );
    }
}