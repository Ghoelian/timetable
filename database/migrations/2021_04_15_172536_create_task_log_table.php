<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTaskLogTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('incident_statuses', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('user_id')->nullable(false);

            $table->string('name')->nullable(false);
            $table->longText('description')->nullable(true);

            $table->foreign('user_id')->references('id')->on('users');
        });

        Schema::create('incident_definitions', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('status_id')->nullable(false);
            $table->unsignedBigInteger('user_id')->nullable(false);

            $table->string('incident_number')->nullable(false);
            $table->longText('description')->nullable(true);

            $table->foreign('status_id')->references('id')->on('incident_statuses');
            $table->foreign('user_id')->references('id')->on('users');
        });

        Schema::create('task_log', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('user_id')->nullable(false);
            $table->unsignedBigInteger('incident_id')->nullable(false);

            $table->longText('description')->nullable(true);
            $table->unsignedBigInteger('time_spent')->nullable(false);

            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('incident_id')->references('id')->on('incident_definitions');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('task_log');
        Schema::dropIfExists('incident_definitions');
        Schema::dropIfExists('incident_statuses');
    }
}
