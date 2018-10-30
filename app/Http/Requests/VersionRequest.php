<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class VersionRequest extends FormRequest
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
            //新增
            case 'POST':
            case 'PUT':
            case 'PATCH':
            //更新
                return [
                    //
                    'name' => 'required|between:3,50',
                    'project_id' => 'required|integer',
                    'user_id' => 'required|integer',
                    'end_time' => 'required|date|after:created_at',

                ];
            case 'GET':
            case 'DELETE':
            default:
                return [];
        }
    }

    public function messages() {
        return [
            'name.required' => '版本名称必须填写',
            'name.between' => '版本名称最少3个字最多50个字',
            'project_id.required' => '请选择项目',
            'user_id.required' => '请选择版本管理员',
            'end_time.required' => '请填写上线时间',
            'end_time.after' => '上线时间错误',

        ];
    }

}
