<?php

use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // sample users of every role
        DB::table('users')->insert([
            [
            	// admin user
            	'f_name' => 'admin',
	            'l_name' => 'user',
	            'username' => 'admin',
	            'email' => 'admin@email.com',
	            'password' => bcrypt('password'),
            ],
            [
            	// frc user
            	'f_name' => 'frc',
	            'l_name' => 'user',
	            'username' => 'frc',
	            'email' => 'frc@email.com',
	            'password' => bcrypt('password'),
            ],
            [
            	// c2 user
            	'f_name' => 'c2',
	            'l_name' => 'user',
	            'username' => 'c2',
	            'email' => 'c2@email.com',
	            'password' => bcrypt('password'),
            ],
            [
            	// cc user
            	'f_name' => 'cc',
	            'l_name' => 'user',
	            'username' => 'cc',
	            'email' => 'cc@email.com',
	            'password' => bcrypt('password'),
            ],
            [
            	// dfo user
            	'f_name' => 'dfo',
	            'l_name' => 'user',
	            'username' => 'dfo',
	            'email' => 'dfo@email.com',
	            'password' => bcrypt('password'),
            ],
            [
            	// aa3 user
            	'f_name' => 'aa3',
	            'l_name' => 'user',
	            'username' => 'aa3',
	            'email' => 'aa3@email.com',
	            'password' => bcrypt('password'),
            ],
            [
            	// ao1 user
            	'f_name' => 'ao1',
	            'l_name' => 'user',
	            'username' => 'ao1',
	            'email' => 'ao1@email.com',
	            'password' => bcrypt('password'),
            ],
            [
            	// director user
            	'f_name' => 'director',
	            'l_name' => 'user',
	            'username' => 'director',
	            'email' => 'director@email.com',
	            'password' => bcrypt('password'),
            ],
        ]);
    }
}
