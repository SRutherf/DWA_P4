<?php

use Illuminate\Database\Seeder;

class ItemsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('items')->insert([
        'name' => 'Beanie',
        'price' => '$0',
    	]);
		
		DB::table('items')->insert([
        'name' => 'Trapper Hat',
        'price' => '$50',
    	]);
		
		DB::table('items')->insert([
        'name' => 'Top Hat',
        'price' => '$1000',
    	]);
		
		DB::table('items')->insert([
        'name' => 'Ski Suit',
        'price' => '$0',
    	]);
		
		DB::table('items')->insert([
        'name' => 'Fur Coat',
        'price' => '$50',
    	]);
		
		DB::table('items')->insert([
        'name' => 'Tuxedo',
        'price' => '$1000',
    	]);
    }
}