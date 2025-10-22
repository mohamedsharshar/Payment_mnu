<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PostsSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('posts')->insert([
            [
                'id' => 1,
                'title' => 'بيان حاله',
                'value' => '200',
                'created_at' => null,
                'updated_at' => null
            ]
        ]);
    }
}
