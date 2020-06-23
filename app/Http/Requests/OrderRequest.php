<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OrderRequest extends FormRequest
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
            'client_id' => 'required',
            'user_id' => 'required',
            'status_id' => 'required',
            'products' => 'required',
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
            'client_id.required' => __('order.validate.client_id'),
            'user_id.required' => __('order.validate.user_id'),
            'status_id.required' => __('order.validate.status_id'),
            'products.required' => __('order.validate.products'),
        ];
    }
}
