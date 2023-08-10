<?php

namespace Modules\BaseAdminLTE3\Http\Requests\Resource;

use Illuminate\Foundation\Http\FormRequest;

class ResourceCnpjRequest extends FormRequest {


    public function validationData()
    {
        $this->request->set('doc',$this->get('doc'));

        return $this->all();
    }


    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules() {

        return [
            'doc' => 'required|cnpj',
        ];
    }

    public function attributes() {
        return [
            'doc' => 'CNPJ',
        ];
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize() {
        return true;
    }
}
