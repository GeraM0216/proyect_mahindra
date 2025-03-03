<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class DeepSeekService
{
    protected $apiKey;
    protected $baseUrl;

    public function __construct()
    {
        $this->apiKey = config('sk-cab0d97cc1264ebfba335fec2c1a3fc0');
        $this->baseUrl = config('https://api.deepseek.com');
    }

    public function requestDeepSeek($mensajeUsuario)
    {
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $this->apiKey,
            'Content-Type' => 'application/json',
        ])->post($this->baseUrl . '/v1/chat/completions', [
            'mensaje' => $mensajeUsuario,
        ]);

        return $response->json();
    }
}