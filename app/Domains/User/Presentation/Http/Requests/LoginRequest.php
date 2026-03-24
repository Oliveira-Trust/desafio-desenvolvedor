<?php

namespace App\Domains\User\Presentation\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'email' => ['required', 'email'],
            'password' => ['required', 'string'],
        ];
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'email' => $this->normalizeEmail($this->input('email')),
            'password' => $this->input('password'),
        ]);
    }

    /**
     * @return array{email: string, password: string}
     */
    public function credentials(): array
    {
        /** @var array{email: string, password: string} $validated */
        $validated = $this->validated();

        return $validated;
    }

    private function normalizeEmail(mixed $value): string
    {
        return mb_strtolower(trim((string) $value));
    }
}
