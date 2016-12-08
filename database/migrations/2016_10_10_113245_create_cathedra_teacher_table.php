<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCathedraTeacherTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('cathedra_teacher', function(Blueprint $table)
		{
			$table->integer('cathedra_id')->unsigned();
			$table->integer('teacher_id')->unsigned();
			$table->primary(['cathedra_id','teacher_id']);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('cathedra_teacher');
	}

}
