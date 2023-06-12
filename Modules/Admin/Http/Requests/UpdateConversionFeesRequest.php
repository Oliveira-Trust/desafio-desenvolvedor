<?php

namespace Modules\Admin\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Modules\Converter\Helpers\FormatHelper;

class UpdateConversionFeesRequest extends FormRequest
{

    public function prepareForValidation()
    {
        $this->merge([
            'less_than_3000' => FormatHelper::inputNumberStringToFloat($this->input('less_than_3000')),
            'more_than_3000' => FormatHelper::inputNumberStringToFloat($this->input('more_than_3000'))
        ]);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'less_than_3000' => 'required|min:0|max:100|numeric',
            'more_than_3000' => 'required|min:0|max:100|numeric',
        ];
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }
}
