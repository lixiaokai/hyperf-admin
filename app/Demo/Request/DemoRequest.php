<?php

namespace App\Demo\Request;

use Core\Request\FormRequest;

/**
 * 演示 - 创建|修改 - 请求类.
 */
class DemoRequest extends FormRequest
{
    public const SCENE_CREATE = 'create';

    protected $scenes = [
        self::SCENE_CREATE => ['name'],
    ];

    public function rules(): array
    {
        return [
            'name' => ['bail', 'required', 'string', 'max:250'],
            'remark' => ['bail', 'string', 'max:250'],
        ];
    }

    public function attributes(): array
    {
        return [
            'name' => '名称',
            'remark' => '备注',
        ];
    }
}
