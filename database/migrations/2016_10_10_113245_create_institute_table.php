<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateInstituteTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('institute', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('name');
			$table->integer('university_id')->unsigned();
			$table->string('site')->nullable();
			$table->string('email')->nullable();
			$table->string('phone')->nullable();
            $table->timestamps();
            $table->softDeletes();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('institute');
	}

}
