<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AssignmentsModify extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::drop('groups_assignments');
        Schema::create('groups_assignments', function (Blueprint $table){
            $table->integer('group_id')->unsigned();
            $table->increments('id')->unsigned();
            $table->string('assignment_name');
            $table->timestamps();
        });

        Schema::table('groups_files', function(Blueprint $table)
        {
            $table->integer('assignment_id')->unsigned();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('assignments');
        Schema::drop('groups_assignments');
    }
}
