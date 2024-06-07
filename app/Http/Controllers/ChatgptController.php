<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ChatgptController extends Controller
{
    public function index(): JsonResponse
    {
        $search = "Who is google";

        $data = Http::withHeaders([
            "Content-Type" => "application/json",
            "Authorization" => "Bearer ".env('OPEN_API_KEY'),
        ])
            ->post('https://api.openai.com/v1/chat/completions',[
            "model" => "gpt-3.5-turbo",
            "messages" => [
                [
                    "role" => "user",
                    "content" => $search
                ]

            ],
            "temperature" => 0.5,
            "max_tokens" => 200,
            "top_p" => 0.1,
            "frequency_penalty" => 0.52,
            "presence_penalty" => 0.5,
            "stop" => [
                '11.'
            ],
        ])->json();

        dd($data);

        return response()->json($data['choices'][0]['message'],200,array(),JSON_PRETTY_PRINT);
    }
}
