<?php

declare(strict_types=1);

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Response;

class FormRequestAbstract extends FormRequest
{
    protected function failedValidation(Validator $validator): void
    {
        $content['errors'] = [];

        foreach ($validator->errors()->all() as $errorMessage) {
            $content['errors'][] = ['message' => $errorMessage];
        }

        $response = response()->json($content, Response::HTTP_UNPROCESSABLE_ENTITY);

        throw new HttpResponseException($response);
    }
}
