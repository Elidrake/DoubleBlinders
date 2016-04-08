<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateFilesCommentsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('files_comments', function(Blueprint $table)
		{
			$table->integer('file_id')->unsigned();
			$table->integer('comment_id')->unsigned();
			$table->timestamps();
			$table->primary(['file_id','comment_id']);
			$table->unique(['file_id','comment_id']);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('files_comments');
	}

}
