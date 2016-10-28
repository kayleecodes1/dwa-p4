<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProjectUsersTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {

        Schema::create('project_users', function (Blueprint $table) {
            $table->foreign('project_id')->references('id')->on('projects');
            $table->foreign('user_id')->references('id')->on('users');
            $table->primary(['project_id', 'user_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {

        Schema::drop('project_users');
    }
}
