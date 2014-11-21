<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateChildTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
 Schema::create('tabDataChild', function ($table) {
	$table->increments('id')->unsigned();
	$table->string('table_name');
	$table->string('column_name');
	$table->string('data_value')->nullable();
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
		Schema::drop('tabDataChild');
	}

}
