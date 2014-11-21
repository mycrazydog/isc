<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateParentTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		 Schema::create('tabDataParent', function ($table) {
			$table->increments('id')->unsigned();
			$table->string('table_name');
			$table->string('column_name');
			$table->string('system_data')->nullable();
			$table->integer('max_length')->nullable();
			$table->integer('precision')->nullable();
			$table->integer('complete')->nullable();
			$table->integer('percentage')->nullable();
			$table->integer('batch_id')->unsigned();
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('tabDataParent');
	}

}
