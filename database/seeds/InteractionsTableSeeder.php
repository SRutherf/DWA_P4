<?php

use Illuminate\Database\Seeder;

class InteractionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('interactions')->insert([
        'id' => '1',
        'question' => 'Yo you like my kickflips bro!?',
        'answ_a' => 'Totally!',
        'answ_b' => 'I guess!',
        'answ_c' => 'Nah!',
    	]);
		
		DB::table('interactions')->insert([
        'id' => '2',
        'question' => 'Wanna hit the slopes together some time dude!?',
        'answ_a' => 'For shore!',
        'answ_b' => 'What?!',
        'answ_c' => 'Nuh uh.',
    	]);
		
		DB::table('interactions')->insert([
        'id' => '3',
        'question' => 'Bro watch me hit this jump!',
        'answ_a' => 'OK!',
        'answ_b' => 'Alright.',
        'answ_c' => 'Why?',
    	]);
		
		DB::table('interactions')->insert([
        'id' => '4',
        'question' => 'You wanna go out sometime bro?!  Watch a movie or something!?',
        'answ_a' => 'Goodness!',
        'answ_b' => 'Oh jeez, I dunno.',
        'answ_c' => 'I have a boyfriend.',
    	]);
		
		DB::table('interactions')->insert([
        'id' => '5',
        'question' => 'Did I just do a sweet kickflip player?!',
        'answ_a' => 'It was dank!',
        'answ_b' => 'It was bangin!',
        'answ_c' => 'It was fletch!',
    	]);
    }
}
