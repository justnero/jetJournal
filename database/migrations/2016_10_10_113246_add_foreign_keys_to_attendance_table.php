<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToAttendanceTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('attendance', function(Blueprint $table)
		{
			$table->foreign('class_id', 'attendance_class_id_fk')->references('id')->on('class')->onUpdate('CASCADE')->onDelete('CASCADE');
			$table->foreign('student_id', 'attendance_student_id_fk')->references('id')->on('student')->onUpdate('CASCADE')->onDelete('CASCADE');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('attendance', function(Blueprint $table)
		{
			$table->dropForeign('attendance_class_id_fk');
			$table->dropForeign('attendance_student_id_fk');
		});
	}

}
