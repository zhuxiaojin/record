<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize() {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules() {
        switch ($this->method()) {
            case 'POST':
                return [
                    //
                    'name' => 'bail|required|between:2,10',
                    'password' => 'bail|required|min:6|confirmed',
                    'email' => 'bail|required|email|unique:users,email',
                    'duty_id' => 'required|integer'
                ];
                break;
            case 'PUT':
            case 'PATCH':
                return [
                    //
                    'name' => 'bail|required|between:2,10',
                    'password' => 'bail|nullable|min:6|confirmed',
                    'email' => 'bail|required|email|unique:users,email,' . \Auth::id(),
                    'duty_id' => 'required|integer'
                ];
                break;
            case 'DELETE':
            case 'GET':
            default:
                return [];
                break;
        }

    }

    public function messages() {
        return [
            'name.required' => '姓名不能为空',
            'email.required' => '邮箱不能为空',
            'email.email' => '邮箱格式错误',
            'duty_id.required' => '职务不能为空',
            'password.required' => '密码不能为空',
            'password.confirmed' => '确认密码不一致',
        ];
    }
}
