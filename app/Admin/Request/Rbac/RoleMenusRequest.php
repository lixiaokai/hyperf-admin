<?php

namespace App\Admin\Request\Rbac;

use Core\Constants\Status;
use Core\Model\Role;
use Core\Request\FormRequest;
use Hyperf\Validation\Rule;

/**
 * 角色管理 - 修改 - 权限菜单 - 请求类.
 */
class RoleMenusRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'menuIds' => ['bail', 'array'],
            'menuIds.*' => ['bail', 'integer',
                Rule::exists(Role::table(), 'id')->where('status', Status::ENABLE),
            ],
        ];
    }

    public function attributes(): array
    {
        return [
            'menuIds' => '权限菜单',
            'menuIds.*' => '权限菜单',
        ];
    }
}
