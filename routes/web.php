<?php

use App\AI\Chat;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('roast');
});

Route::post('/roast', function () {
    $attributes = request()->validate([
        'topic' => [
            'required', 'string', 'min:2', 'max:50'
        ]
    ]);

    $mp3 = (new Chat())->send(
        message: "Please roast {$attributes['topic']} in a funny and sarcastic tone.",
        speech: true
    );

    file_put_contents(public_path($file = "/roasts/".md5($mp3).".mp3"), $mp3);

    return redirect('/')->with([
        'file'  => $file,
        'flash' => 'Boom. Roasted.'
    ]);
});
