<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class userDataTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($userIterator=1; $userIterator < 22; $userIterator++) { 
        	DB::table('user_data')->insert([
        		'street' => Str::random(10),
        		'number' => rand(0, 120),
        		'city' => Str::random(10),
        		'user_id' => $userIterator
        	]);
        }
    }
}
