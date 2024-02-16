<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('categories')->truncate();
        DB::table('categories')->insert([
            [
                'title' => 'Coding',
                'slug' => 'coding',
                'priority' => 1,
                'status' => 1,
                'parent_id' => 0
            ],
            [
                'title' => 'Database',
                'slug' => 'database',
                'priority' => 2,
                'status' => 1,
                'parent_id' => 0     
            ],
            [
                'title' => 'DS & Algo',
                'slug' => 'ds-algo',
                'priority' => 3,
                'status' => 1,
                'parent_id' => 0
            ]
        ]);
    }
}
