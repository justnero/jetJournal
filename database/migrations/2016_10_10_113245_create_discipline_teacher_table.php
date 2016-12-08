<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateDisciplineTeacherTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('discipline_teacher', function(Blueprint $table)
		{
			$table->integer('discipline_id')->unsigned();
			$table->integer('teacher_id')->unsigned();
			$table->primary(['discipline_id','teacher_id']);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('discipline_teacher');
	}

}
