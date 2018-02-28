<?php

namespace App\Http\Requests\Api;

class VerificationCodeRequest extends Request
{
    public function rules()
    {
        return [
            'phone' => 'required|regex:/^1[34578]\d{9}$/|unique:users',
        ];
    }
}
