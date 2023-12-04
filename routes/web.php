<?php

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    $poem = Http::withToken(config('services.openai.secret'))
        ->post('https://api.openai.com/v1/chat/completions',
            [
                "model"    => "gpt-3.5-turbo",
                "messages" => [
                    [
                        "role"    => "system",
                        "content" => "You are a poetic assistant, skilled in explaining complex programming concepts with creative flair."
                    ],
                    [
                        "role"    => "user",
                        "content" => "Compose a poem that explains the concept of recursion in programming."
                    ]
                ]
            ])->json('choices.0.message.content');

    return view('welcome', ['poem' => $poem]);
});
