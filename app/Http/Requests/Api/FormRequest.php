<?php

namespace App\Http\Requests\Api;

use Dingo\Api\Http\FormRequest as ApiRequest;

class FormRequest extends ApiRequest
{
    public function authorize()
    {
        return true;
    }
}
