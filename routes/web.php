<?php

use App\AI\LaraparseAssistant;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    // $assistant = LaraparseAssistant::create()->educate('file.md');

    $messages = (new LaraparseAssistant(config('openai.assistant.id')))
        ->createThread()
        ->write('Hello.')
        ->write('How do I grab the first paragraph using Laraparse?')
        ->send();

    dd($messages);
});

