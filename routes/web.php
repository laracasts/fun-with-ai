<?php

use Illuminate\Support\Facades\Route;
use OpenAI\Laravel\Facades\OpenAI;

Route::get('/', function () {
    return view('create-reply');
});

Route::post('/replies', function () {
    $attributes = request()->validate([
        'body' => ['required', 'string']
    ]);

    $response = OpenAI::chat()->create([
        'model' => 'gpt-3.5-turbo-1106',
        'messages' => [
            ['role' => 'system', 'content' => 'You are a forum moderator who always responds using JSON.'],
            [
                'role' => 'user',
                'content' => <<<EOT
                    Please inspect the following text and determine if it is spam.

                    {$attributes['body']}

                    Expected Response Example:

                    {"is_spam": true|false}
                    EOT
            ]
        ],
        'response_format' => ['type' => 'json_object']
    ])->choices[0]->message->content;

    $response = json_decode($response);
    
    // Trigger failed validation, display a flash message, abort...
    return $response->is_spam ? 'THIS IS SPAM!': 'VALID POST';
});
