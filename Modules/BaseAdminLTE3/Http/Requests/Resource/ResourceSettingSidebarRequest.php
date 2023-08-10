<?php

namespace Modules\BaseAdminLTE3\Http\Requests\Resource;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\ValidationException;

class ResourceSettingSidebarRequest extends FormRequest {

    protected function prepareForValidation()
    {

        $this->merge([
            'value' => $this->get('value') === 'true',
        ]);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules() {

        return [
            'value' => 'boolean',
        ];
    }


    public function attributes() {
        return [
            'postcode' => 'Valor',
        ];
    }

    /* public function messages() {
         return [
             'postpone.digits' => 'O Cep é inválido!',
         ];
     }*/


    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize() {
        return true;
    }
}
