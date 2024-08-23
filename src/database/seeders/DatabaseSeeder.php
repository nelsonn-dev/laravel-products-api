<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => Hash::make('password')
        ]);

        $this->call([
            RoleSeeder::class,
            PermissionSeeder::class,
            CategorySeeder::class,
            ProductSeeder::class,
        ]);

        DB::table('roles_permissions')->insert([
            [
                'role_id' => 1,
                'permission_id' => 1,
                "created_at" =>  now(),
                "updated_at" => now(),
            ],
            [
                'role_id' => 1,
                'permission_id' => 2,
                "created_at" =>  now(),
                "updated_at" => now(),
            ],
            [
                'role_id' => 1,
                'permission_id' => 3,
                "created_at" =>  now(),
                "updated_at" => now(),
            ],
            [
                'role_id' => 1,
                'permission_id' => 4,
                "created_at" =>  now(),
                "updated_at" => now(),
            ],
            [
                'role_id' => 2,
                'permission_id' => 5,
                "created_at" =>  now(),
                "updated_at" => now(),
            ],
            [
                'role_id' => 2,
                'permission_id' => 6,
                "created_at" =>  now(),
                "updated_at" => now(),
            ],
            [
                'role_id' => 2,
                'permission_id' => 7,
                "created_at" =>  now(),
                "updated_at" => now(),
            ],
            [
                'role_id' => 2,
                'permission_id' => 8,
                "created_at" =>  now(),
                "updated_at" => now(),
            ],
        ]);

        DB::table('users_roles')->insert([
            [
                'user_id' => 1,
                'role_id' => 1,
                "created_at" =>  now(),
                "updated_at" => now(),
            ],
        ]);
    }
}
