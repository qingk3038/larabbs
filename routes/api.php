<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

$api = app('Dingo\Api\Routing\Router');

$api->version('v1', [
    'namespace' => 'App\Http\Controllers\Api',
    'as' => 'api',
], function ($api) {
    $api->group([
        'middleware' => 'api.throttle',
        'limit' => config('api.rate_limits.sign.limit'),
        'expires' => config('api.rate_limits.sign.expires'),
    ], function ($api) {
        // 发送短信验证码
        $api->post('verificationCodes', 'VerificationCodesController@store')->name('verificationCodes.store');
        // 用户注册
        $api->post('users', 'UsersController@store')->name('users.store');
        // 图片验证码
        $api->post('captchas', 'CaptchasController@store')->name('captchas.store');
    });
});
