<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Api\VerificationCodeRequest;
use Illuminate\Http\Request;

class VerificationCodesController extends Controller
{
    public function store(VerificationCodeRequest $request)
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
