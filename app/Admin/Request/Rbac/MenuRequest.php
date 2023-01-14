<?php

namespace App\Admin\Request\Rbac;

use Core\Constants\MenuType;
use Core\Constants\Platform;
use Core\Constants\RequestMethod;
use Core\Constants\Status;
use Core\Request\FormRequest;
use Hyperf\Validation\Rule;

/**
 * 菜单管理 - 创建|修改 - 请求类.
 */
class MenuRequest extends FormRequest
{
    public const SCENE_UPDATE = 'update';

    protected $scenes = [
        // 说明：parent_id 创建后不能修改
        self::SCENE_UPDATE => ['platform', 'app_id', 'method', 'path', 'uri', 'name', 'remark', 'icon', 'type', 'status', 'sort'],
    ];

    public function rules(): array
    {
        return [
            'parent_id' => ['bail', 'nullable', 'integer'],
            'platform' => ['bail', 'required', 'string', Rule::in(Platform::codes())],
            'app_id' => ['bail', 'nullable', 'integer'],
            'method' => ['bail', 'nullable', 'string', Rule::in(RequestMethod::codes())],
            'path' => ['bail', 'string', 'max:100'],
            'uri' => ['bail', 'string', 'max:100'],
            'name' => ['bail', 'required', 'string', 'max:20'],
            'remark' => ['bail', 'string', 'max:250'],
            'icon' => ['bail', 'string', 'max:50'],
            'type' => ['bail', 'required', 'string', Rule::in(MenuType::codes())],
            'status' => ['bail', 'required', 'string', Rule::in(Status::codes())],
            'sort' => ['bail', 'required', 'integer', 'max:999'],
        ];
    }

    public function attributes(): array
    {
        return [
            'parent_id' => '上级权限菜单',
            'platform' => '终端平台',
            'app_id' => '应用',
            'method' => '请求方式',
            'path' => '前端路由',
            'uri' => '路由 Uri',
            'name' => '名称',
            'remark' => '备注',
            'icon' => '图标',
            'type' => '类型',
            'status' => '状态',
            'sort' => '排序',
        ];
    }
}
