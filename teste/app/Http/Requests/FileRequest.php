<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class FileRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool {
        return Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array {
        return [
            'file' => ['required','file','mimetypes:text/csv,text/plain,application/vnd.ms-excel,application/vnd.openxmlformats-officedocument.spreadsheetml.sheet']
        ];
    }

    public function messages(): array {
        return [
            'file.required' => 'É obrigarório o envio de arquivo csv/xlsx/xls!',
            'file.file' => 'É necessário um arquivo csv/xlsx/xls.',
            'file.mimetypes' => 'É necessário um arquivo com extensão valida, sendo csv/xlsx/xls!'
        ];
    }
}
