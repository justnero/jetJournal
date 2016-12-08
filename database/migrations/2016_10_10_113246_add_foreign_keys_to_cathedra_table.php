<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToCathedraTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('cathedra', function(Blueprint $table)
		{
			$table->foreign('institute_id', 'cathedra_institute_id_fk')->references('id')->on('institute')->onUpdate('RESTRICT')->onDelete('RESTRICT');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('cathedra', function(Blueprint $table)
		{
			$table->dropForeign('cathedra_institute_id_fk');
		});
	}

}
