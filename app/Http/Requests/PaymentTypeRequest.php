<?php

namespace App\Http\Requests;

use App\Exceptions\ValidatorException;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Arr;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;

class PaymentTypeRequest extends FormRequest
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
        $rules = [
            'name' => 'required',
            'fee' => 'required|numeric|between:0,100',
            'status' => 'required|boolean',
        ];
        return $this->method() === 'PATCH' ? Arr::only($rules, $this->request->keys()) : $rules;
    }

    protected function failedValidation(Validator $validator)
    {
        try{
            parent::failedValidation($validator);
        } catch (ValidationException $e) {
            throw new ValidatorException($e->errors());
        }
    }
}
