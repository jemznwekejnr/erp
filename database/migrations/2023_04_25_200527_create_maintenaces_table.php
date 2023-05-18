<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMaintenacesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('maintenaces', function (Blueprint $table) {
            $table->id();
            $table->string('name', 255);
            $table->string('number');
            $table->Timestamp('date')->default(now());
            $table->string('type', 255);
            $table->integer('recurring_option')->nullable(false);
            $table->string('status', 50)->default("scheduled");
            $table->string('attachment', 255)->nullable(true);

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
        Schema::dropIfExists('maintenaces');
    }
}
