<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Permission::updateOrCreate(
            ['name' => 'view_dashboard'],
            ['name' => 'view_dashboard']
        );

        $master = User::find(1);

        $master->assignRole('Master');
    }
}
