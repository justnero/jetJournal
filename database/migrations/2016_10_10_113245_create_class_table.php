<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateClassTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('class', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('discipline_id')->unsigned();
			$table->integer('teacher_id')->unsigned()->nullable();
			$table->integer('group_id')->unsigned();
			$table->dateTime('date')->nullable();
			$table->enum('type', array('lection','laboratory','practice','seminar','course'));
            $table->timestamps();
            $table->softDeletes();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('class');
	}

}
