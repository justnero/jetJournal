<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToCertificateTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('certificate', function(Blueprint $table)
		{
			$table->foreign('student_id', 'certificate_student_id_fk')->references('id')->on('student')->onUpdate('CASCADE')->onDelete('CASCADE');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('certificate', function(Blueprint $table)
		{
			$table->dropForeign('certificate_student_id_fk');
		});
	}

}
