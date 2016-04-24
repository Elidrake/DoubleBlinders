<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGroupsFilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('groups_files', function (Blueprint $table) {
            $table->integer('group_id')->unsigned();
	    $table->integer('file_id')->unsigned();
	    $table->dateTime('created_at');
	    $table->dateTime('updated_at');
	    $table->primary(['group_id','file_id']);
            $table->unique(['group_id','file_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('groups_files');
    }
}
