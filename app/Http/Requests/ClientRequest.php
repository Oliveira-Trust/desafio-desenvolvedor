<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ClientRequest extends FormRequest
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
            'name' => 'required|max:255',
            'dob' => 'date',
            'email' => 'required|email',
            'address' => 'required',
            'contact' => 'required',
            'user_id' => 'required',
            'status_id' => 'required',
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'name.required' => __('client.validate.name'),
            'dob.required' => __('client.validate.dob'),
            'email.required' => __('client.validate.email'),
            'address.required' => __('client.validate.address'),
            'contact.required' => __('client.validate.contact'),
            'user_id.required' => __('client.validate.user_id'),
            'status_id.required' => __('client.validate.status_id'),
        ];
    }
}
