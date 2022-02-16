<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;

class CustomRulesRequest extends FormRequest
{
    /**
     * This method is the core of this class. It will call the other methods dynamically
     *
     * @return  Array
     */
    public function rules(): Array
    {
        $method = "validateTo" . Str::ucfirst($this->route()->getActionMethod());
        return \method_exists($this, $method) ? $this->$method() : $this->emptyValidate();
    }
}
