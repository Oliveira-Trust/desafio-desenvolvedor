<?php declare(strict_types=1);

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UploadFileRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'file' => [
                'required',
                'file',
                'mimes:csv,xlsx,xls,txt',
                'max:102400', // 100 MB
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'file.required' => 'O arquivo é obrigatório.',
            'file.file' => 'O campo deve conter um arquivo válido.',
            'file.mimes' => 'Apenas arquivos CSV, XLSX e XLS são aceitos.',
            'file.max' => 'O arquivo não pode ser maior que 100 MB.',
        ];
    }
}
