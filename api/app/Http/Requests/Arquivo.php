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
            'file' =>  'required|file|mime:zip, xlsx, xls, csv, txt| max: 204800', // Limite Máximo 200MB 
        ];
    }
}
