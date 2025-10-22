<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ServicesSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('services')->insert([
            [
                'ID' => 1,
                'SERVICESName' => 'بيان حاله',
                'value' => 200
            ],
            [
                'ID' => 2,
                'SERVICESName' => 'تربية عسكريه',
                'value' => 500
            ],
            [
                'ID' => 3,
                'SERVICESName' => 'رسم القيد',
                'value' => 1500
            ]
        ]);
    }
}
