<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class ValidCpf implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        // Remover caracteres não numéricos
        $cpf = preg_replace('/[^0-9]/', '', $value);

        // Verificar se o CPF tem 11 dígitos
        if (strlen($cpf) != 11) {
            $fail($this->message('length'));
            return;
        }

        // Verificar se todos os dígitos são iguais (caso inválido)
        if (preg_match('/(\d)\1{10}/', $cpf)) {
            $fail($this->message('equal_digits'));
            return;
        }

        // Calcular os dígitos verificadores para validar o CPF
        for ($t = 9; $t < 11; $t++) {
            for ($d = 0, $c = 0; $c < $t; $c++) {
                $d += $cpf[$c] * (($t + 1) - $c);
            }
            $d = ((10 * $d) % 11) % 10;
            if ($cpf[$c] != $d) {
                $fail($this->message('invalid'));
                return;
            }
        }
    }

    /**
     * Get the validation error message.
     *
     * @param  string $type
     * @return string
     */
    public function message($type = 'invalid')
    {
        $messages = [
            'length' => 'O CPF deve ter 11 dígitos.',
            'equal_digits' => 'O CPF não pode conter todos os dígitos iguais.',
            'invalid' => 'O CPF não é válido.'
        ];

        return $messages[$type] ?? $messages['invalid'];
    }
}
