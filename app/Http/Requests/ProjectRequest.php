<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProjectRequest extends FormRequest
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
            case 'PATCH':
            case 'PUT':
                return [
                    //
                    'name' => 'bail|required|between:5,50',
                    'body' => 'bail|required',
                    'user_id' => 'bail|required|integer|exists:users,id',
                    'img' => 'bail|nullable',

                ];
                break;
            case 'DELETE':
            case 'GET':
                return [
                    //
                ];
                break;
        }

    }

    public function messages() {
        return [
            'name.required' => '项目名称不能为空',
            'name.between' => '项目名称5-50个字',
            'body.required' => '项目简介不能为空',
            'user_id.required' => '请选择项目经理',
            'user_id.exists' => '您选择的项目经理不存在',
        ];

    }
}
