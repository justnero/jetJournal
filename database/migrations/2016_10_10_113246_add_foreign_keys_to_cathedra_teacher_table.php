<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToCathedraTeacherTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('cathedra_teacher', function(Blueprint $table)
		{
			$table->foreign('cathedra_id', 'cathedra_teacher_cathedra_id_fk')->references('id')->on('cathedra')->onUpdate('CASCADE')->onDelete('CASCADE');
			$table->foreign('teacher_id', 'cathedra_teacher_teacher_id_fk')->references('id')->on('teacher')->onUpdate('CASCADE')->onDelete('CASCADE');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('cathedra_teacher', function(Blueprint $table)
		{
			$table->dropForeign('cathedra_teacher_cathedra_id_fk');
			$table->dropForeign('cathedra_teacher_teacher_id_fk');
		});
	}

}
