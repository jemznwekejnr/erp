<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBuildingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('buildings', function (Blueprint $table) {
            $table->id();
            $table->string('name', 255)->nullable();
            $table->text('description')->nullable();
            $table->Timestamp('start_date')->default(now());
            $table->string('training_type', 255)->default("pending");
            $table->integer('duration')->nullable(false);
            $table->string('training_mode', 50);
            $table->string('status', 50)->default("to-do");
            $table->foreignId('requested_by');
            $table->Timestamp('training_date')->nullable(true);
            $table->Timestamp('approval_date')->nullable(true);
            $table->Timestamp('decline_date')->nullable(true);
            $table->Timestamp('end_date')->nullable(true);
            $table->text('trainees')->nullable(true);

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
        Schema::dropIfExists('buildings');
    }
}
