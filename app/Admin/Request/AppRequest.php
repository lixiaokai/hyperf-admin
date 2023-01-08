<?php

namespace App\Admin\Request;

use Core\Constants\Status;
use Core\Request\FormRequest;
use Hyperf\Validation\Rule;

/**
 * 应用 - 创建|修改 - 请求类.
 */
class AppRequest extends FormRequest
{
    public const SCENE_UPDATE = 'update';

    protected $scenes = [
        self::SCENE_UPDATE => ['name', 'sort', 'status'], // 说明：key 创建后不能修改
    ];

    public function rules(): array
    {
        return [
            'key' => ['bail', 'required', 'string', 'max:20'],
            'name' => ['bail', 'required', 'string', 'max:20'],
            'sort' => ['bail', 'required', 'integer', 'max:999'],
            'status' => ['bail', 'required', 'string', Rule::in(Status::codes())],
        ];
    }

    public function attributes(): array
    {
        return [
            'key' => '应用 Key',
            'name' => '应用名称',
            'sort' => '排序',
            'status' => '状态',
        ];
    }
}
