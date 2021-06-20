<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SituationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('situations')->insert([
            [
                'id' => 1,
                'situation_desc' => 'Iniciada'
            ],
            [
                'id' => 2,
                'situation_desc' => 'Pendente'
            ],
            [
                'id' => 3,
                'situation_desc' => 'Cancelada'
            ],
            [
                'id' => 4,
                'situation_desc' => 'Concluída'
            ],
        ]);
    }
}
