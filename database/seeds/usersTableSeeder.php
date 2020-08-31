<?php

use Illuminate\Database\Seeder;

class usersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $password = Hash::make('password');
       	for ($userIterator=0; $userIterator < 20; $userIterator++) { 
       		DB::table('users')->insert([
       			'name' => Str::random(10),
       			'email' => 'user'.$userIterator.'@fakemail.com',
       			'password' => $password
       		]);	
       	}
       	DB::table('users')->insert([
       		'name' => 'test',
       		'email' => 'test@fakemail.com',
       		'password' => $password
       	]);	
     
    }
}
