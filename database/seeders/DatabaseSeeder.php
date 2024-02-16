<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        //\App\Models\PostCategory::factory(20)->create();
        //\App\Models\Post::factory(30)->create();

        \App\Models\User::factory()->create([
            'name' => 'Lana Septiana',
            'username' => 'iamelse',
            'email' => 'lana.septiana2@gmail.com',
            'password' => 'password'
        ]);

        \App\Models\User::factory()->create([
            'name' => 'Tatang Basher',
            'username' => 'tatang',
            'email' => 'tatang@gmail.com',
            'password' => 'password'
        ]);

        \App\Models\PostCategory::factory()->create([
            'name' => 'Coding',
            'slug' => 'coding',
        ]);

        $this->call(RoleSeeder::class);
        $this->call(PermissionSeeder::class);
    }
}
