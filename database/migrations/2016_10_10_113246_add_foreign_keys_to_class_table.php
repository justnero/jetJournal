<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToClassTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('class', function(Blueprint $table)
		{
			$table->foreign('discipline_id', 'class_discipline_id_fk')->references('id')->on('discipline')->onUpdate('CASCADE')->onDelete('CASCADE');
			$table->foreign('group_id', 'class_group_id_fk')->references('id')->on('group')->onUpdate('CASCADE')->onDelete('CASCADE');
			$table->foreign('teacher_id', 'class_teacher_id_fk')->references('id')->on('teacher')->onUpdate('CASCADE')->onDelete('SET NULL');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('class', function(Blueprint $table)
		{
			$table->dropForeign('class_discipline_id_fk');
			$table->dropForeign('class_group_id_fk');
			$table->dropForeign('class_teacher_id_fk');
		});
	}

}
