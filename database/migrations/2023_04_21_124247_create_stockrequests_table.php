<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStockrequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stockrequests', function (Blueprint $table) {
            $table->id();
            $table->integer('qty_requested');
            $table->foreignId('requested_by');
            $table->foreignId('stock_id');
            $table->foreignId('recipient_id');
            $table->string('copy_id', 255)->nullable(true);
            $table->Timestamp('request_date')->default(now());
            $table->Timestamp('approval_date')->nullable(true);
            $table->Timestamp('decline_date')->nullable(true);
            $table->Timestamp('disburse_date')->nullable(true);
            $table->foreignId('treated_by')->nullable(true);
            $table->text('purpose')->nullable(true);
            $table->text('treat_comment')->nullable(true);
            $table->string('status', 50);
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
        Schema::dropIfExists('stockrequests');
    }
}
