<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Api\VerificationCodeFormRequest;

class VerificationCodesController extends Controller
{
    public function store(VerificationCodeFormRequest $request)
    {
        $phone = $request->phone;

        $result = send_sms($phone);

        if ($result['status']) {
            return $this->response->array($result['data'])->setStatusCode(201);
        } else {
            return $this->response->errorInternal($result['msg']);
        }
    }
}
