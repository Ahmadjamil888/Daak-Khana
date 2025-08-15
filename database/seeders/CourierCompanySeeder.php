<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\CourierCompany;
use App\Models\CourierService;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class CourierCompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create sample Pakistani courier companies
        $companies = [
            [
                'user' => [
                    'name' => 'TCS Express Pakistan',
                    'email' => 'admin@tcs.com.pk',
                    'password' => Hash::make('password'),
                    'user_type' => 'courier',
                    'phone' => '+92-21-111-123-456',
                    'address' => 'TCS House, Karachi, Pakistan',
                ],
                'company' => [
                    'company_name' => 'TCS Express Pakistan',
                    'description' => 'Pakistan\'s leading courier and logistics company with over 25 years of experience. We provide reliable same-day, next-day, and international delivery services across Pakistan and worldwide.',
                    'ai_generated_description' => 'TCS is Pakistan\'s most trusted courier service provider offering comprehensive logistics solutions with nationwide coverage and international reach.',
                    'service_areas' => ['Karachi', 'Lahore', 'Islamabad', 'Rawalpindi', 'Faisalabad', 'Multan', 'Peshawar', 'Quetta'],
                    'rating' => 4.8,
                    'total_reviews' => 2156,
                    'base_price' => 150.00,
                    'pricing_structure' => [
                        'base_rate' => 150.00,
                        'per_km' => 2.50,
                        'per_kg' => 5.00,
                    ],
                    'is_verified' => true,
                    'is_featured' => true,
                    'operating_hours' => [
                        'monday' => '8:00-18:00',
                        'tuesday' => '8:00-18:00',
                        'wednesday' => '8:00-18:00',
                        'thursday' => '8:00-18:00',
                        'friday' => '8:00-18:00',
                        'saturday' => '9:00-15:00',
                        'sunday' => 'closed',
                    ],
                    'license_number' => 'TCS-PK-2024-001',
                    'insurance_details' => 'Fully insured up to Rs. 100,000 per package',
                ],
                'services' => [
                    [
                        'service_name' => 'Same Day Express',
                        'description' => 'Urgent same-day delivery within major cities',
                        'service_type' => 'same_day',
                        'price' => 500.00,
                        'delivery_time' => '4-6 hours',
                        'max_weight' => 25.0,
                        'package_types' => ['documents', 'small_packages', 'electronics'],
                    ],
                    [
                        'service_name' => 'Next Day Standard',
                        'description' => 'Reliable next-day delivery across Pakistan',
                        'service_type' => 'next_day',
                        'price' => 200.00,
                        'delivery_time' => '1 business day',
                        'max_weight' => 50.0,
                        'package_types' => ['documents', 'packages', 'electronics', 'clothing'],
                    ],
                ],
            ],
            [
                'user' => [
                    'name' => 'Leopards Courier Services',
                    'email' => 'info@leopardscourier.com',
                    'password' => Hash::make('password'),
                    'user_type' => 'courier',
                    'phone' => '+92-42-111-456-789',
                    'address' => 'Leopards House, Lahore, Pakistan',
                ],
                'company' => [
                    'company_name' => 'Leopards Courier Services',
                    'description' => 'Fast and reliable courier services across Pakistan with specialized e-commerce solutions. We offer cash on delivery, same-day delivery, and bulk shipping services.',
                    'ai_generated_description' => 'Leopards Courier Services provides comprehensive logistics solutions with a focus on e-commerce deliveries and cash on delivery services.',
                    'service_areas' => ['Lahore', 'Karachi', 'Islamabad', 'Faisalabad', 'Multan', 'Sialkot', 'Gujranwala'],
                    'rating' => 4.6,
                    'total_reviews' => 1489,
                    'base_price' => 120.00,
                    'pricing_structure' => [
                        'base_rate' => 120.00,
                        'per_km' => 2.00,
                        'per_kg' => 4.00,
                    ],
                    'is_verified' => true,
                    'is_featured' => true,
                    'operating_hours' => [
                        'monday' => '9:00-17:00',
                        'tuesday' => '9:00-17:00',
                        'wednesday' => '9:00-17:00',
                        'thursday' => '9:00-17:00',
                        'friday' => '9:00-17:00',
                        'saturday' => '9:00-14:00',
                        'sunday' => 'closed',
                    ],
                    'license_number' => 'LCS-PK-2024-002',
                    'insurance_details' => 'E-commerce coverage up to Rs. 50,000 per shipment',
                ],
                'services' => [
                    [
                        'service_name' => 'E-commerce Express',
                        'description' => 'Specialized e-commerce delivery with COD',
                        'service_type' => 'express',
                        'price' => 180.00,
                        'delivery_time' => '1-2 business days',
                        'max_weight' => 30.0,
                        'package_types' => ['packages', 'electronics', 'clothing', 'books'],
                    ],
                    [
                        'service_name' => 'Cash on Delivery',
                        'description' => 'COD service with payment collection',
                        'service_type' => 'cod',
                        'price' => 150.00,
                        'delivery_time' => '2-3 business days',
                        'max_weight' => 25.0,
                        'package_types' => ['packages', 'electronics', 'clothing'],
                    ],
                ],
            ],
            [
                'user' => [
                    'name' => 'Blue EX Pakistan',
                    'email' => 'contact@blueex.com',
                    'password' => Hash::make('password'),
                    'user_type' => 'courier',
                    'phone' => '+92-51-111-258-369',
                    'address' => 'Blue EX Center, Islamabad, Pakistan',
                ],
                'company' => [
                    'company_name' => 'Blue EX Pakistan',
                    'description' => 'Modern courier service with advanced tracking technology and nationwide coverage. Specializing in business deliveries, e-commerce solutions, and international shipping.',
                    'ai_generated_description' => 'Blue EX offers cutting-edge courier services with real-time tracking, nationwide coverage, and specialized business solutions.',
                    'service_areas' => ['Islamabad', 'Rawalpindi', 'Karachi', 'Lahore', 'Peshawar', 'Multan', 'Hyderabad'],
                    'rating' => 4.7,
                    'total_reviews' => 892,
                    'base_price' => 140.00,
                    'pricing_structure' => [
                        'base_rate' => 140.00,
                        'per_km' => 2.25,
                        'per_kg' => 4.50,
                    ],
                    'is_verified' => true,
                    'is_featured' => false,
                    'operating_hours' => [
                        'monday' => '8:00-19:00',
                        'tuesday' => '8:00-19:00',
                        'wednesday' => '8:00-19:00',
                        'thursday' => '8:00-19:00',
                        'friday' => '8:00-19:00',
                        'saturday' => '9:00-16:00',
                        'sunday' => '10:00-14:00',
                    ],
                    'license_number' => 'BEX-PK-2024-003',
                    'insurance_details' => 'Advanced coverage for business and personal deliveries',
                ],
                'services' => [
                    [
                        'service_name' => 'Business Express',
                        'description' => 'Priority business delivery with tracking',
                        'service_type' => 'express',
                        'price' => 250.00,
                        'delivery_time' => '4-6 hours',
                        'max_weight' => 20.0,
                        'package_types' => ['documents', 'contracts', 'samples'],
                    ],
                    [
                        'service_name' => 'Standard Delivery',
                        'description' => 'Economical delivery service nationwide',
                        'service_type' => 'standard',
                        'price' => 140.00,
                        'delivery_time' => '2-3 business days',
                        'max_weight' => 40.0,
                        'package_types' => ['packages', 'documents', 'electronics'],
                    ],
                ],
            ],
        ];

        foreach ($companies as $companyData) {
            // Create user
            $user = User::create($companyData['user']);
            
            // Create company
            $company = CourierCompany::create(array_merge(
                $companyData['company'],
                ['user_id' => $user->id]
            ));
            
            // Create services
            foreach ($companyData['services'] as $serviceData) {
                CourierService::create(array_merge(
                    $serviceData,
                    ['courier_company_id' => $company->id]
                ));
            }
        }

        // Create a sample customer user
        User::create([
            'name' => 'Ahmed Ali',
            'email' => 'customer@example.com',
            'password' => Hash::make('password'),
            'user_type' => 'customer',
            'phone' => '+92-300-1234567',
            'address' => 'Block A, Gulshan-e-Iqbal, Karachi, Pakistan',
        ]);
    }
}