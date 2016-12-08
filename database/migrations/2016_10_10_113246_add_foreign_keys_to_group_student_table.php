<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToGroupStudentTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('group_student', function(Blueprint $table)
		{
			$table->foreign('group_id', 'group_student_group_id_fk')->references('id')->on('group')->onUpdate('CASCADE')->onDelete('CASCADE');
			$table->foreign('student_id', 'group_student_student_id_fk')->references('id')->on('student')->onUpdate('CASCADE')->onDelete('CASCADE');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('group_student', function(Blueprint $table)
		{
			$table->dropForeign('group_student_group_id_fk');
			$table->dropForeign('group_student_student_id_fk');
		});
	}

}
