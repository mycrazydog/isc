<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBatchTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		 Schema::create('tabDataBatch', function ($table) {
			$table->increments('id')->unsigned();
			$table->integer('user_id')->unsigned();
			$table->integer('partner_id')->unsigned();
			$table->text('batch_description')->nullable();
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
		Schema::drop('tabDataBatch');
	}

}
