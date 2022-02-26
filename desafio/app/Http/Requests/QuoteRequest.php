<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Exceptions\ValueNotAllowedException;

class QuoteRequest extends FormRequest
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
        if ($this->isMethod('post')) {
            return [
                'codein' => 'required|max:3',
                'conversion_value' => 'required',
                'payment_method' => 'required'
            ];
        }

        return [];
    }

    /**
     * @return array
     * @throw ValueNotAllowedException
     */
    public function getRequest()
    {
        $dataRequest = $this->all();
        $dataRequest['conversion_value'] = removeDecimal($dataRequest['conversion_value']);

        if (($dataRequest['conversion_value'] < 1000) || ($dataRequest['conversion_value'] > 100000))
            throw new ValueNotAllowedException(trans('exception.valueNotAllowed'), 409);
       
        return $dataRequest;
    }
}
