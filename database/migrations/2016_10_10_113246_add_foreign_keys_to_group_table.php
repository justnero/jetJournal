<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToGroupTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('group', function(Blueprint $table)
		{
			$table->foreign('cathedra_id', 'group_cathedra_id_fk')->references('id')->on('cathedra')->onUpdate('CASCADE')->onDelete('SET NULL');
			$table->foreign('super_id', 'group_group_id_fk')->references('id')->on('group')->onUpdate('CASCADE')->onDelete('CASCADE');
			$table->foreign('steward_id', 'group_student_id_fk')->references('id')->on('student')->onUpdate('CASCADE')->onDelete('SET NULL');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('group', function(Blueprint $table)
		{
			$table->dropForeign('group_cathedra_id_fk');
			$table->dropForeign('group_group_id_fk');
			$table->dropForeign('group_student_id_fk');
		});
	}

}
