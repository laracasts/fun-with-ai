<?php

namespace App\Rules;

use App\AI\Assistant;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use OpenAI\Laravel\Facades\OpenAI;

class SpamFree implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(
        string $attribute,
        mixed $value,
        Closure $fail
    ): void {
        $response = (new Assistant)
            ->systemMessage('You are a forum moderator who always responds using JSON.')
            ->send(<<<EOT
                Please inspect the following text and determine if it is spam.

                {$value}

                Expected Response Example:

                {"is_spam": true|false}
                EOT
            );

        if (json_decode($response)?->is_spam) {
            $fail("Spam was detected.");
        }
    }
}
