<?php

namespace Modules\BaseAdminLTE3\Http\Requests\Resource;

use Illuminate\Foundation\Http\FormRequest;

class ResourceClientRequest extends FormRequest {

    public function rules(): array {
        return [
            'name' => ['required', 'min:3', 'max:255']
        ];
    }
}
