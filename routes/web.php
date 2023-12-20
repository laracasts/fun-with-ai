<?php

use App\AI\Assistant;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('image', [
        'messages' => session('messages', [])
    ]);
});

Route::post('/image', function () {
    $attributes = request()->validate([
        'description' => ['required', 'string', 'min:3']
    ]);

    $assistant = new Assistant(session('messages', []));

    $assistant->visualize($attributes['description']);

    session(['messages' => $assistant->messages()]);

    return redirect('/');
});
