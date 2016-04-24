<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AssignmentsCreate extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('assignments', function (Blueprint $table) {
            $table->increments('id');
            $table->string('assignmentName');
            $table->timestamps();
        });

        Schema::create('groups_assignments', function (Blueprint $table){
            $table->integer('group_id')->unsigned();
            $table->integer('assignment_id')->unsigned();
            $table->timestamps();
            $table->primary(['group_id','assignment_id']);
            $table->unique(['group_id','assignment_id']);
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
