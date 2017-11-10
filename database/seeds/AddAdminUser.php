<?php

use Illuminate\Database\Seeder;

class AddAdminUser extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('users')->insert([
        	'first_name' => 'Andre',
        	'last_name' => 'Ramayadi',
        	'email' => 'andre.ramayadi@gmail.com',
        	'password' => bcrypt('qwerty'),
        	'dob' => date('Y-m-d H:i:s', strtotime('11/12/1980')),
        	'country_id' => 360,
        	'state' => 'Bali',
        	'city' => 'Denpasar',
            'isActivated' => 1,
        	'remember_token' => str_random(10),
        	'created_at' => \Carbon\Carbon::now(),
        	'updated_at' => \Carbon\Carbon::now(),
        	]);
    }
}
