<?php

namespace App\Http\Controllers;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\JsonResponse;
use function Pest\Laravel\post;

class OpenAIController extends Controller
{
    public function consultaChat(Request $request): JsonResponse
    {

        $search= "Who is google";

        $data = Http::withHeaders([
            'Content-Type'=>'application\json',
            'Authorization' => 'Bearer'.env('OPEN_API_KEY'),
        ])
        ->post('https://api.deepseek.com',[
            'model' => 'deepseek',
            'messages'=>[
                [
                    "role" => 'user',
                    'content'=> $search
                ]
                ],
                'temperature'=> 0.5,
                'max_tokens'=> 200,
                'top_p'=> 1.0,
                'frecuency_penalty'=> 0.52,
                'presence_penalty'=>0.5,
                'stop'=> ["11."],
        ])->json();
        return response()->json($data);
    }
}
