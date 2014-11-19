<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLicensesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
public function up()
{
    // Create the `Posts` table
    Schema::create('licenses', function ($table) {
	$table->increments('id')->unsigned();
	$table->integer('user_id')->unsigned();
	$table->integer('funding');
	$table->integer('policy');
	$table->integer('program');	
	$table->integer('evaluate');
	$table->integer('responsible');
	$table->integer('confidential');
	$table->integer('irb');
	$table->integer('benefit');
	$table->integer('credentials');	
	$table->string('initial', 30);	
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
		  Schema::drop('licenses');
	}

}

