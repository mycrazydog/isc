<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddCustomFieldsToPosts extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('posts', function(Blueprint $table)
		{
			//
			$table->text('partnerwebsite');
			$table->text('status');
			$table->text('yearsavailable');
			$table->text('notescleaning');
			$table->text('notessource');
			$table->text('notesversion');

		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('posts', function(Blueprint $table)
		{
			//
			$table->dropColumn('partnerwebsite');
			$table->dropColumn('status');
			$table->dropColumn('yearsavailable');
			$table->dropColumn('notescleaning');
			$table->dropColumn('notessource');
			$table->dropColumn('notesversion');

		});
	}

}
