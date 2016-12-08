<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToInstituteTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('institute', function(Blueprint $table)
		{
			$table->foreign('university_id', 'institute_university_id_fk')->references('id')->on('university')->onUpdate('CASCADE')->onDelete('CASCADE');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('institute', function(Blueprint $table)
		{
			$table->dropForeign('institute_university_id_fk');
		});
	}

}
