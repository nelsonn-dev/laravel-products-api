<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('categories')->insert([
            'name' => 'Food',
            "created_at" =>  now(),
            "updated_at" => now(),
        ]);

        DB::table('categories')->insert([
            'name' => 'Informatics',
            "created_at" =>  now(),
            "updated_at" => now(),
        ]);

        DB::table('categories')->insert([
            'name' => 'Home',
            "created_at" =>  now(),
            "updated_at" => now(),
        ]);

        DB::table('categories')->insert([
            'name' => 'Toys',
            "created_at" =>  now(),
            "updated_at" => now(),
        ]);
    }
}
