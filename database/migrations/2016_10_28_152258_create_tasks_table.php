<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTasksTable extends Migration {

    public function up() {

        Schema::create('tasks', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('project_id')->unsigned();
            $table->foreign('project_id')->references('id')->on('projects');
            $table->integer('assignee_id')->unsigned()->nullable();
            $table->foreign('assignee_id')->references('id')->on('users');
            $table->string('title');
            $table->string('description');
            $table->enum('status', ['To Do', 'In Progress', 'Done']);
            $table->timestamps();
        });
    }

    public function down() {

        DB::statement('SET FOREIGN_KEY_CHECKS = 0');
        Schema::drop('tasks');
        DB::statement('SET FOREIGN_KEY_CHECKS = 1');
    }
}
