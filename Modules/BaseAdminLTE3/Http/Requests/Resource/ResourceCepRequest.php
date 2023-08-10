<?php

namespace Modules\BaseAdminLTE3\Http\Requests\Resource;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\ValidationException;

class ResourceCepRequest extends FormRequest {

    /*public function validationData()
    {

        return $this->all();
    }*/


    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules() {

        return [
            'postcode' => 'required|bail|digits:' . fieldLength('addresses.postcode'),
        ];
    }


    public function attributes() {
        return [
            'postcode' => 'Cep',
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
