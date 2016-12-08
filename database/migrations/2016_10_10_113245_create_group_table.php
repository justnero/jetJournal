<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateGroupTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('group', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('name', 64);
			$table->integer('course')->nullable();
			$table->integer('cathedra_id')->unsigned()->nullable();
			$table->integer('steward_id')->unsigned()->nullable();
			$table->integer('super_id')->unsigned()->nullable();
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
		Schema::drop('group');
	}

}
