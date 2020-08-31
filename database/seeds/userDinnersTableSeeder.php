<?php

use Illuminate\Database\Seeder;

class userDinnersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$dinners = DB::table('dinners')->select('id', 'user_data_id as host_id')->get();
        for ($userIterator=0; $userIterator < 10; $userIterator++) { 
			$dinnerId = rand(1,4);
			$hostId = $dinners[$dinnerId]->host_id;
			$guestIdIsNotHostId = false;
			$guestId = rand(1, 20);
        	while($guestIdIsNotHostId != true){
        		if($guestId != $hostId)
        			$guestIdIsNotHostId = true;
        		else
        			$guestId = rand(0, 20);
        	}
        	DB::table('user_dinners')->insert([
        		'user_data_id' => $guestId,
        		'dinner_id' => rand(1, count($dinners)),
        	]);
        }
    }
}
