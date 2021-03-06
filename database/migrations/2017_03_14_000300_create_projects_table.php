<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProjectsTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('projects', function (Blueprint $table) {
			$table->increments('id');
			$table->string('name');
			$table->text('body')->nullable();
			$table->string('state')->default('drafted');
			$table->date('start_date')->default(date("Y-m-d H:i:s"));
			$table->date('end_date')->nullable();
			$table->string('featured');
			$table->string('permalink');
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
		Schema::dropIfExists('projects');
	}
}
