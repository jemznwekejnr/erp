<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Vouchersheet extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vouchersheet', function (Blueprint $table) {
            $table->id();
            $table->string("pvid");
            $table->string("description");
            $table->integer("qty")->nullable();
            $table->double("unitprice")->nullable();
            $table->double("amount")->nullable();
            $table->double("vatpercent")->nullable();
            $table->double("vatamount")->nullable();
            $table->double("grossamount")->nullable();
            $table->double("whtpercent")->nullable();
            $table->double("whtamount")->nullable();
            $table->double("netamount")->nullable();
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
        Schema::dropIfExists('vouchersheet');
    }
}
