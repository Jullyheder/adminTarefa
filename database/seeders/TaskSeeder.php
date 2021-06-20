<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TaskSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tasks')->insert([
            [
                'id' => 1,
                'task_desc' => 'Teste 1',
                'category_id' => 1,
                'priority_id' => 1,
                'situation_id' => 1,
                'user_id' => 2,
                'data_limit' => date('Y-m-d', strtotime("+9 days")),
                'annotate' => 'Texto aleatorio1',
            ],
            [
                'id' => 2,
                'task_desc' => 'Teste 2',
                'category_id' => 2,
                'priority_id' => 2,
                'situation_id' => 1,
                'user_id' => 3,
                'data_limit' => date('Y-m-d', strtotime("+7 days")),
                'annotate' => 'Texto aleatorio2',
            ],
            [
                'id' => 3,
                'task_desc' => 'Teste 3',
                'category_id' => 3,
                'priority_id' => 3,
                'situation_id' => 1,
                'user_id' => 2,
                'data_limit' => date('Y-m-d', strtotime("+4 days")),
                'annotate' => 'Texto aleatorio3',
            ],
            [
                'id' => 4,
                'task_desc' => 'Teste 4',
                'category_id' => 4,
                'priority_id' => 4,
                'situation_id' => 1,
                'user_id' => 3,
                'data_limit' => date('Y-m-d', strtotime("+2 days")),
                'annotate' => 'Texto aleatorio4',
            ],
            [
                'id' => 5,
                'task_desc' => 'Teste 5',
                'category_id' => 5,
                'priority_id' => 5,
                'situation_id' => 1,
                'user_id' => 3,
                'data_limit' => date('Y-m-d', strtotime("+1 days")),
                'annotate' => 'Texto aleatorio5',
            ],
        ]);
    }
}
