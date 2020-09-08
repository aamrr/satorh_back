<?php

use App\Training;
use Illuminate\Database\Seeder;

class TrainingTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Training::create([
            'entitled' => 'Laravel',
            'user_id' => 5
        ]);

        Training::create([
            'entitled' => 'VueJS',
            'user_id' => 6
        ]);

        Training::create([
            'entitled' => 'Codeigniter',
            'user_id' => 7
        ]);
    }
}
