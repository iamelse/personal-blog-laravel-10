<?php

namespace Database\Seeders;

use App\Enums\RoleEnum;
use App\Enums\PermissionEnum;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach (RoleEnum::cases() as $roleEnum) {
            $role = Role::firstOrCreate(['name' => $roleEnum->value]);

            foreach ($roleEnum->permissions() as $permissionEnum) {
                $permission = Permission::firstOrCreate(['name' => $permissionEnum->value]);
                $role->givePermissionTo($permission);
            }
        }

        $this->command->info('Roles and permissions seeded successfully.');
    }
}