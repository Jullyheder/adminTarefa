<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ModSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('mods')->insert([
            [
                'id' => 1,
                'mod_desc' => 'Administrador'
            ],
            [
                'id' => 2,
                'mod_desc' => 'Usuário'
            ],
        ]);
    }
}
