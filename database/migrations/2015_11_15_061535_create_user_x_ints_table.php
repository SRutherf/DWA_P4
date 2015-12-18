<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserXIntsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users_x_interactions', function (Blueprint $table) {
            $table->integer('user_id');
			$table->integer('visitor_id');
			$table->integer('interaction_id');
			$table->string('result');
		});
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('users_x_interactions');
    }
}
