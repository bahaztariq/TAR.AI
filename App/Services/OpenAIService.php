<?php

namespace App\Services;

use OpenAI;

class OpenAIService
{
    private $client;

    public function __construct()
    {
        $apiKey = trim($_ENV['OPENAI_API_KEY'] ?? getenv('OPENAI_API_KEY'));

        if (!$apiKey) {
            $apiKey = 'YOUR_API_KEY_HERE';
        }

        $this->client = OpenAI::client($apiKey);
    }

    public function generateResponse(string $prompt): string
    {
        try {
            $result = $this->client->chat()->create([
                'model' => 'gpt-3.5-turbo',
                'messages' => [
                    ['role' => 'user', 'content' => $prompt],
                ],
            ]);

            return $result->choices[0]->message->content;
        } catch (\Exception $e) {
            return "Error: " . $e->getMessage();
        }
    }
}
