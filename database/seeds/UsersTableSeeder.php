<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	DB::table('users')->insert([
        'name' => 'Jill',
        'email' => 'jill@harvard.edu',
        'password' => \Hash::make('helloworld'),
        'outfit' => '1,3',
        'items' => 'hat1,body1',
        'money' => 999999,
        'created_at' => Carbon\Carbon::now()->toDateTimeString(),
        'updated_at' => Carbon\Carbon::now()->toDateTimeString(),
    	]);
		
		DB::table('users')->insert([
        'name' => 'Jamal',
        'email' => 'jamal@harvard.edu',
        'password' => \Hash::make('helloworld'),
        'outfit' => '2,1',
        'items' => 'hat1,body1',
        'money' => 999999,
        'created_at' => Carbon\Carbon::now()->toDateTimeString(),
        'updated_at' => Carbon\Carbon::now()->toDateTimeString(),
    	]);
		
        DB::table('users')->insert([
        'name' => 'testerson',
        'email' => 'stevenrutherford@socal.rr.com',
        'password' => \Hash::make('test'),
        'outfit' => '3,2',
        'items' => 'hat1,body1',
        'money' => 999999,
        'created_at' => Carbon\Carbon::now()->toDateTimeString(),
        'updated_at' => Carbon\Carbon::now()->toDateTimeString(),
    	]);
		
		DB::table('users')->insert([
        'name' => 'testerson2',
        'email' => 'steven2rutherford@socal.rr.com',
        'password' => \Hash::make('test'),
        'outfit' => '1,2',
        'items' => 'hat1,body1',
        'money' => 999999,
        'created_at' => Carbon\Carbon::now()->toDateTimeString(),
        'updated_at' => Carbon\Carbon::now()->toDateTimeString(),
    	]);
		
		DB::table('users')->insert([
        'name' => 'testerson3',
        'email' => 'steven3rutherford@socal.rr.com',
        'password' => \Hash::make('test'),
        'outfit' => '2,2',
        'items' => 'hat1,body1',
        'money' => 999999,
        'created_at' => Carbon\Carbon::now()->toDateTimeString(),
        'updated_at' => Carbon\Carbon::now()->toDateTimeString(),
    	]);
    }
}