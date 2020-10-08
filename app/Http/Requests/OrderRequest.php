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
            'status' => 'required',
            'client_id' => 'required',
            'product_id' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'status.required' => 'Status is Required',
            'client_id.required' => 'Client is Required',
            'Product_id.required' => 'Product is Required'
        ];
    }
}
