<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToDisciplineTeacherTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('discipline_teacher', function(Blueprint $table)
		{
			$table->foreign('discipline_id', 'discipline_teacher_discipline_id_fk')->references('id')->on('discipline')->onUpdate('CASCADE')->onDelete('CASCADE');
			$table->foreign('teacher_id', 'discipline_teacher_teacher_id_fk')->references('id')->on('teacher')->onUpdate('CASCADE')->onDelete('CASCADE');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('discipline_teacher', function(Blueprint $table)
		{
			$table->dropForeign('discipline_teacher_discipline_id_fk');
			$table->dropForeign('discipline_teacher_teacher_id_fk');
		});
	}

}
