<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RecordRequest extends FormRequest
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
            case 'PUT':
            case 'PATCH':
                return [
                    //
                    'project_id' => 'required|integer',
                    'version_id' => 'required|integer',
                    'step_id' => 'required|integer',
                    'work_time' => 'required|integer',
                    'current_time' => 'required|date',
                    'body' => 'required|between:2,100',
                ];
            case 'GET':
            case 'DELETE':
                return [];

        }

    }

    public function messages() {
        return [
            'project_id.required' => '请选择项目',
            'version_id.required' => '请选择版本',
            'step_id.required' => '请选择阶段',
            'work_time.required' => '请填写工作时长',
            'current_time.required' => '请填写发布日期',
            'body.required' => '正确填写工作内容哦~~',
            'body.between' => '正确填写工作内容哦~~',
        ];
    }
}
