<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTables extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('measurements', function($table)
		{
			$table->increments('measure_id', 11);
			$table->string('measure_title', 25);
			$table->timestamps();
		});

		Schema::create('tasks', function($table)
		{
			$table->increments('task_id', 11);
			$table->string('task_title', 25);
			$table->timestamps();
		});

		Schema::create('users', function($table)
		{
			$table->increments('emp_id', 11);
			$table->string('user_name', 25);
			$table->string('first_name', 15);
			$table->string('last_name', 15);
			$table->string('email', 35);
			$table->string('password', 64)
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		//
	}

}
