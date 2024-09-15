<?php

namespace App\Http\Requests;

use App\Models\Upload;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class UploadFileRequest extends FormRequest
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
            'file' => [
                'required',
                'file',
                'mimes:csv,txt,xlsx',
                function ($attribute, $value, $fail) {
                    // Obtém o nome do arquivo
                    $fileName = $value->getClientOriginalName();

                    // Verifica se o arquivo já existe no banco de dados
                    if (Upload::where('name', $fileName)->exists()) {
                        $fail('O arquivo já foi enviado anteriormente.');;
                    }
                },
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'file.required' => 'O arquivo é obrigatório.',
            'file.file'     => 'O arquivo deve ser um arquivo válido.',
            'file.mimes'    => 'O arquivo deve ser do tipo: csv, xlsx.',
        ];
    }

    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'success'   => false,
            'message'   => 'Validation errors',
            'data'      => $validator->errors()
        ],400));
    }

}
