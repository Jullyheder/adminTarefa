<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->insert([
            [
                'id' => 1,
                'category_desc' => 'Exemplo 1',
                'priority_id' => 1
            ],
            [
                'id' => 2,
                'category_desc' => 'Exemplo 2',
                'priority_id' => 2
            ],
            [
                'id' => 3,
                'category_desc' => 'Exemplo 3',
                'priority_id' => 3
            ],
            [
                'id' => 4,
                'category_desc' => 'Exemplo 4',
                'priority_id' => 4
            ],
            [
                'id' => 5,
                'category_desc' => 'Exemplo 5',
                'priority_id' => 5
            ],
        ]);
    }
}
