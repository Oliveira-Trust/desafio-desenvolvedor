<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class Arquivo extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'file' =>  'required|file|mimes:zip,xlsx,xls,csv,txt|max:102400', // Limite Máximo100MB 
        ];
    }
    // Mensagens de erro personalizadas (opcional)
    public function messages(): array
    {
        return [
            'file.required' => 'O arquivo é obrigatório.',
            'file.file' => 'Por favor, envie um arquivo válido.',
            'file.mimes' => 'O arquivo deve ser do tipo CSV, TXT, XLS ou XLSX.',
            'file.max' => 'O arquivo não pode ter mais de 200MB.',
        ];
    }
}
