<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SearchRequest extends FormRequest
{
    public function authorize() { return true; }

    public function rules()
    {
        return [
            'TckrSymb' => 'sometimes|string',
            'RptDt'    => 'sometimes|date_format:Y-m-d',
            'page'     => 'sometimes|integer|min:1',
        ];
    }
}
