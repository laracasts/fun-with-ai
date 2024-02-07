<?php

use Illuminate\Support\Facades\Route;
use OpenAI\Laravel\Facades\OpenAI;

Route::get('/', function () {
    $file = OpenAI::files()->upload([
        'purpose' => 'assistants',
        'file'    => fopen(storage_path('docs/parsing.md'), 'rb')
    ]);

    $assistant = OpenAI::assistants()->create([
        'model'        => 'gpt-4-1106-preview',
        'name'         => 'Laraparse Tutor',
        'instructions' => 'You are a helpful programming teacher.',
        'tools'        => [
            ['type' => 'retrieval']
        ],
        'file_ids'     => [
            $file->id
        ]
    ]);

    $run = OpenAI::threads()->createAndRun([
        'assistant_id' => $assistant->id,
        'thread'       => [
            'messages' => [
                ['role'    => 'user',
                 'content' => 'How do I grab the first paragraph?'
                ]
            ]
        ]
    ]);

    do {
        sleep(1);

        $run = OpenAI::threads()->runs()->retrieve(
            threadId: $run->threadId,
            runId: $run->id
        );
    } while ($run->status !== 'completed');

    $messages = OpenAI::threads()->messages()->list($run->threadId);

    dd($messages);
});

