<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProjectFeedbacksTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('project_feedbacks', function (Blueprint $table) {
			$table->increments('id');
			$table->integer('project_id');
			// $table->integer('client_id');
			$table->string('title');
			$table->text('body')->nullable();
			$table->integer('satisfaction')->default(0);
			$table->string('state')->default('drafted');
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
		Schema::dropIfExists('project_feedbacks');
	}
}
