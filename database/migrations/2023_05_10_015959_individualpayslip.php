<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Individualpayslip extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('individualpayslip', function (Blueprint $table) {
            $table->id();
            $table->string('month');
            $table->integer('payid');
            $table->string('staff');
            $table->string('designation');
            $table->double('basicpay');
            $table->double('allowances');
            $table->double('grosspay');
            $table->double('alloweddeduction');
            $table->double('staffbonus');
            $table->double('staffdeduction');
            $table->double('netpay');
            $table->string('status');
            $table->string('created_by');
            $table->timestamps();
            $table->string('updated_by');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('individualpayslip');
    }
}
