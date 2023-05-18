<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Leaveapplication extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('leaveapplication', function (Blueprint $table) {
            $table->id();
            $table->date('leavedate');
            $table->integer('staff');
            $table->string('department');
            $table->string('designation');
            $table->string('employeestatus');
            $table->integer('leavetype');
            $table->date('startdate');
            $table->date('enddate');
            $table->string('handover')->nullable();
            $table->string('standin')->nullable();
            $table->string('duration');
            $table->string('daystaken');
            $table->string('daysleft');
            $table->string('status');
            $table->string('remark')->nullable();
            $table->string('sendto');
            $table->string('copy');
            $table->string('title');
            $table->string('body', 1000);
            $table->string('attachment')->nullable();
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
        Schema::dropIfExists('leaveapplication');
    }
}
