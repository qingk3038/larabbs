<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Auth;

class UserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => [
                'required',
                'between:2,25',
                'regex:/(^[a-z\d\-\_]+$|^[\x{4e00}-\x{9fa5}]+$)/ui',
                'unique:users,name,' . Auth::id(),
            ],
            'email' => 'required|email',
            'introduction' => 'max:80',
            'avatar' => 'mimes:jpeg,bmp,png,gif|dimensions:min_width=200,min_height=200',
        ];
    }

    public function messages()
    {
        return [
            'avatar.mimes' =>'头像 必须是一个 jpeg, bmp, png, gif 类型的文件。',
            'avatar.dimensions' => '图片的清晰度不够，宽和高需要 200px 以上。',
            'name.required' => '用户名 不能为空。',
            'name.between' => '用户名 必须介于 2 - 25 个字符之间。',
            'name.regex' => '用户名 格式不正确。',
            'name.unique' => '用户名 已经存在。',
        ];
    }
}
