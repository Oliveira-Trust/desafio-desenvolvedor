<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
            'description' => 'required',
            'image' => 'required',
            'price' => 'required',
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
            'name.required' => __('product.validate.name'),
            'description.required' => __('product.validate.description'),
            'image.required' => __('product.validate.image'),
            'price.required' => __('product.validate.price'),
            'user_id.required' => __('product.validate.user_id'),
            'status_id.required' => __('product.validate.status_id'),
        ];
    }
}
