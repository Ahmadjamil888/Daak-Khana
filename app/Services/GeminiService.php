<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Exception;

class GeminiService
{
    private $apiKey;
    private $apiUrl;

    public function __construct()
    {
        $this->apiKey = config('services.gemini.api_key');
        $this->apiUrl = config('services.gemini.api_url');
    }

    public function generateProfileDescription($companyData)
    {
        try {
            $prompt = "Generate a professional and engaging company profile description for a courier company with the following details:\n\n";
            $prompt .= "Company Name: " . $companyData['company_name'] . "\n";
            $prompt .= "Service Areas: " . implode(', ', $companyData['service_areas'] ?? []) . "\n";
            $prompt .= "Base Price: PKR " . $companyData['base_price'] . "\n";
            $prompt .= "Operating Hours: " . json_encode($companyData['operating_hours'] ?? []) . "\n\n";
            $prompt .= "Please create a compelling 2-3 paragraph description that highlights the company's strengths, reliability, and service quality. Make it professional yet approachable.";

            return $this->makeRequest($prompt);
        } catch (Exception $e) {
            throw new Exception('Failed to generate profile description: ' . $e->getMessage());
        }
    }

    public function handleOrderWithAI($orderDetails, $prompt)
    {
        try {
            $systemPrompt = "You are an AI assistant for a courier company. Help process and respond to order-related queries. Here are the order details:\n\n";
            $systemPrompt .= "Order Number: " . $orderDetails['booking_number'] . "\n";
            $systemPrompt .= "Customer: " . $orderDetails['customer_name'] . "\n";
            $systemPrompt .= "Pickup: " . $orderDetails['pickup_address'] . "\n";
            $systemPrompt .= "Delivery: " . $orderDetails['delivery_address'] . "\n";
            $systemPrompt .= "Status: " . $orderDetails['status'] . "\n\n";
            $systemPrompt .= "User Query: " . $prompt . "\n\n";
            $systemPrompt .= "Provide a helpful, professional response. If it's about status updates, delivery estimates, or handling instructions, be specific and actionable.";

            return $this->makeRequest($systemPrompt);
        } catch (Exception $e) {
            throw new Exception('Failed to process order with AI: ' . $e->getMessage());
        }
    }

    public function chatWithDaakKhana($userMessage, $context = [])
    {
        try {
            $prompt = "You are Daak Khana AI, a helpful assistant for Pakistan's premier courier marketplace. ";
            $prompt .= "You help users with courier services, shipping questions, tracking, and general platform assistance. ";
            $prompt .= "Be friendly, professional, and knowledgeable about courier services in Pakistan.\n\n";
            
            if (!empty($context)) {
                $prompt .= "Context: " . json_encode($context) . "\n\n";
            }
            
            $prompt .= "User: " . $userMessage . "\n\n";
            $prompt .= "Please provide a helpful response about courier services, shipping, or platform features.";

            return $this->makeRequest($prompt);
        } catch (Exception $e) {
            throw new Exception('Failed to chat with Daak Khana AI: ' . $e->getMessage());
        }
    }

    public function searchCouriers($searchQuery, $availableCouriers)
    {
        try {
            $prompt = "Help find the best courier service based on this search query: '" . $searchQuery . "'\n\n";
            $prompt .= "Available courier companies:\n";
            
            foreach ($availableCouriers as $courier) {
                $prompt .= "- " . $courier['company_name'] . " (Rating: " . $courier['rating'] . ", Base Price: PKR " . $courier['base_price'] . ")\n";
                $prompt .= "  Services: " . implode(', ', $courier['services'] ?? []) . "\n";
                $prompt .= "  Areas: " . implode(', ', $courier['service_areas'] ?? []) . "\n\n";
            }
            
            $prompt .= "Based on the search query, recommend the most suitable courier companies and explain why they match the user's needs. Be concise but informative.";

            return $this->makeRequest($prompt);
        } catch (Exception $e) {
            throw new Exception('Failed to search couriers with AI: ' . $e->getMessage());
        }
    }

    private function makeRequest($prompt)
    {
        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
        ])->post($this->apiUrl . '?key=' . $this->apiKey, [
            'contents' => [
                [
                    'parts' => [
                        ['text' => $prompt]
                    ]
                ]
            ]
        ]);

        if ($response->failed()) {
            throw new Exception('Gemini API request failed: ' . $response->body());
        }

        $data = $response->json();
        
        if (!isset($data['candidates'][0]['content']['parts'][0]['text'])) {
            throw new Exception('Invalid response format from Gemini API');
        }

        return $data['candidates'][0]['content']['parts'][0]['text'];
    }
}