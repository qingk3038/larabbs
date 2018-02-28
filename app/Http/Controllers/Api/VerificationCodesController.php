<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Api\VerificationCodeFormRequest;
use Cache;

class VerificationCodesController extends Controller
{
    public function store(VerificationCodeFormRequest $request)
    {
        $verifyData = Cache::get($request->captcha_key);

        if (!$verifyData) {
            return $this->response->error('验证码已过期', 422);
        }

        if (!hash_equals($request->captcha_code, $verifyData['captcha'])) {
            Cache::forget($request->captcha_key);

            return $this->response->errorUnauthorized('验证码错误');
        }

        $phone = $verifyData['phone'];

        $result = send_sms($phone);

        Cache::forget($request->captcha_key);

        if ($result['status']) {
            return $this->response->array($result['data'])->setStatusCode(201);
        } else {
            return $this->response->errorInternal($result['msg']);
        }
    }
}
