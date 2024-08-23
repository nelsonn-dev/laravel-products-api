<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Permission::factory()->create(['name' => 'product_view']);
        Permission::factory()->create(['name' => 'product_crete']);
        Permission::factory()->create(['name' => 'product_update']);
        Permission::factory()->create(['name' => 'product_delete']);
        Permission::factory()->create(['name' => 'category_view']);
        Permission::factory()->create(['name' => 'category_create']);
        Permission::factory()->create(['name' => 'category_update']);
        Permission::factory()->create(['name' => 'category_delete']);
    }
}
