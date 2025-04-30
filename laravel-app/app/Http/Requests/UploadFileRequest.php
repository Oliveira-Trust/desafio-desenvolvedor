<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UploadFileRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'file' => 'required|file|csv_file|max:100000',
            'reference_date' => 'nullable|date_format:Y-m-d',
        ];
    }

    /**
     * Get custom messages for validator errors.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'file.required' => 'Um arquivo é obrigatório.',
            'file.file' => 'O upload deve ser um arquivo válido.',
            'file.csv_file' => 'O arquivo deve ser um CSV válido.',
            'file.max' => 'O tamanho máximo permitido é 100MB.',
            'reference_date.date_format' => 'A data de referência deve estar no formato YYYY-MM-DD.',
        ];
    }
} 