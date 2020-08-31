<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class dinnersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($dinnerIterator=0; $dinnerIterator < 5; $dinnerIterator++) { 
        	DB::table('dinners')->insert([
        		'user_data_id' => rand(0,21),
        		'max_guests' => rand(5,15),
        		'start_date' => date('Y-m-d H:i:s'),
        		'duration' => rand(60, 180),
        		'title' => Str::random(10),
        		'description' => (rand(0, 10) < 5) ? Str::random(50) : ""
        	]);

        }
    }
}
