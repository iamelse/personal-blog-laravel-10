<?php

namespace App\Enums;

enum RoleEnum: string
{
    case MASTER = 'Master';
    case AUTHOR = 'Author';

    public function permissions(): array
    {
        return match ($this) {
            self::MASTER => [
                PermissionEnum::DASHBOARD_INDEX,

                PermissionEnum::CREATE_POST,
                PermissionEnum::READ_POST,
                PermissionEnum::UPDATE_POST,
                PermissionEnum::DELETE_POST,

                PermissionEnum::CREATE_USER,
                PermissionEnum::READ_USER,
                PermissionEnum::UPDATE_USER,
                PermissionEnum::DELETE_USER,
                
                PermissionEnum::CREATE_ROLE,
                PermissionEnum::READ_ROLE,
                PermissionEnum::UPDATE_ROLE,
                PermissionEnum::DELETE_ROLE,
            ],
            self::AUTHOR => [
                PermissionEnum::DASHBOARD_INDEX,

                PermissionEnum::CREATE_POST,
                PermissionEnum::READ_POST,
                PermissionEnum::UPDATE_POST,
                PermissionEnum::DELETE_POST,
            ],
        };
    }
}