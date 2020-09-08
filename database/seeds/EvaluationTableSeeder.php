<?php

use App\Evaluation;
use Illuminate\Database\Seeder;

class EvaluationTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Evaluation::create([
            'responsible_id' => 3,
            'user_id' => 5,
            'state' => 'Good'
        ]);

        Evaluation::create([
            'responsible_id' => 2,
            'user_id' => 7,
            'state' => 'Failed'
        ]);
    }
}
