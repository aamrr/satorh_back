<?php

use Illuminate\Database\Seeder;
use App\Skill;

class SkillTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Skill::create([
            'entitled' => 'integration CSS',
            'user_id' => 5,
            'note' => '3.5'
        ]);

        Skill::create([
            'entitled' => 'Agile',
            'user_id' => 6,
            'note' => '4.5'
        ]);
    }
}
