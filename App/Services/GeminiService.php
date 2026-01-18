<?php

namespace App\Services;

use Gemini\Client;

class GeminiService
{
    private $client;

    public function __construct()
    {
        $apiKey = trim($_ENV['GEMINI_API_KEY'] ?? getenv('GEMINI_API_KEY'));

        if (!$apiKey) {
            $apiKey = 'YOUR_GEMINI_API_KEY_HERE';
        }

        $this->client = \Gemini::client($apiKey);
    }

    public function generateResponse(string $prompt): string
    {
        try {
            // Using gemini-2.0-flash as determined previously
            $result = $this->client->generativeModel(model: 'gemini-2.0-flash')->generateContent($prompt);
            return $result->text();
        } catch (\Exception $e) {
            return "Error: " . $e->getMessage();
        }
    }
}
