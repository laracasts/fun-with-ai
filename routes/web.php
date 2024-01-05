<?php

use App\Rules\SpamFree;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('create-reply');
});

Route::post('/replies', function () {
    request()->validate([
        'body' => [
            'required',
            'string',
            new SpamFree()
        ]
    ]);

    return 'Redirect wherever is needed. Post was valid.';
});
