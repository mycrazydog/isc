<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddLicensestatusToLicenses extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('licenses', function(Blueprint $table)
		{
			$table->string('licensestatus')->after('user_id');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('licenses', function(Blueprint $table)
		{
			$table->dropColumn('licensestatus');
		});
	}

}
