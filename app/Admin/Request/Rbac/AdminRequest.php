<?php

namespace App\Admin\Request\Rbac;

use Core\Request\FormRequest;

/**
 * 用户管理 - 创建|修改 - 请求类.
 */
class AdminRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => ['bail', 'required', 'string', 'max:20'],
            'phone' => ['bail', 'required', 'integer'],
        ];
    }

    public function attributes(): array
    {
        return [
            'name' => '用户名',
            'phone' => '手机号',
        ];
    }
}
