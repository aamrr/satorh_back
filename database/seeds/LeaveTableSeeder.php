<?php

use App\Leave;
use Illuminate\Database\Seeder;

class LeaveTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Leave::create([
            'action' => 'rien',
            'user_id' => 6,
            'days_left' => 5,
            'days_consumed' => 2
        ]);

        Leave::create([
            'action' => 'rien',
            'user_id' => 7,
            'days_left' => 3,
            'days_consumed' => 4
        ]);
    }
}
