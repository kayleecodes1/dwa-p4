<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProjectsTable extends Migration {

    public function up() {

        Schema::create('projects', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('owner_id')->unsigned();
            $table->foreign('owner_id')->references('id')->on('users');
            $table->string('title');
            $table->string('description');
            $table->timestamps();
        });
    }

    public function down() {

        DB::statement('SET FOREIGN_KEY_CHECKS = 0');
        Schema::drop('projects');
        DB::statement('SET FOREIGN_KEY_CHECKS = 1');
    }
}
