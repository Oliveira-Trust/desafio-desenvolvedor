<?php

namespace App\Http\Requests;

use App\Models\InstrumentsConsolidatedUploadHistory;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\File;
use Illuminate\Validation\Validator;

class FileRequest extends FormRequest
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
            'files' => 'required',
            'files.*' => [
                'required',
                File::types(['txt', 'csv', 'xlsx']),
            ],
        ];
    }

    protected function withValidator(Validator $validator): void
    {
        $validator->after(function ($validator) {
            $requestFileNames = [];
            foreach ($this->file('files') as $file){
                $requestFileNames[] = $file->getClientOriginalName();
            }

            if(InstrumentsConsolidatedUploadHistory::whereIn('filename', $requestFileNames)->count() > 0)
                $validator->errors()->add('duplicated_filename', 'Arquivo já cadastrado.');
        });
    }

    public function messages()
    {
        return [
            'files.required' => 'Envie ao menos um arquivo.',
            'files.*.mimes' => 'É permitido somente arquivos csv ou Excel (xlsx).'
        ];
    }
}
