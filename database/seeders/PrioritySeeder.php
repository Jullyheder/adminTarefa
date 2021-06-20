<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PrioritySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('priorities')->insert([
            [
                'id' => 1,
                'priority_desc' => 'Muito Baixa'
            ],
            [
                'id' => 2,
                'priority_desc' => 'Baixa'
            ],
            [
                'id' => 3,
                'priority_desc' => 'Média'
            ],
            [
                'id' => 4,
                'priority_desc' => 'Alta'
            ],
            [
                'id' => 5,
                'priority_desc' => 'Muito Alta'
            ],
        ]);
    }
}
