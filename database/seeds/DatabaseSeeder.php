<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            UsersTableSeeder::class,
            EvaluationTableSeeder::class,
            TrainingTableSeeder::class,
            SkillTableSeeder::class,
            LeaveTableSeeder::class
        ]);
    }
}
