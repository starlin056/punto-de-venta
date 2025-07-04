<?php

namespace App\Rules;

use App\Models\Caja; 
use Illuminate\Support\Facades\Auth; 
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class CajaCerradaRule implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string, ?string=): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        //realizamos comprobacion de que el usuario no tenga caja aperturada para poder abrir caja.

        if (caja::where('user_id', Auth::id())->where('estado', 1)->exists()) {
            $fail('Ya tiene una caja aperturada');

        }

    }
}
