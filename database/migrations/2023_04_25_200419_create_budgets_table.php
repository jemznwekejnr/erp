<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBudgetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('budgets', function (Blueprint $table) {
            $table->id();
            $table->integer('number');
            $table->text('description');
            $table->decimal('amount', 12, 2);
            $table->decimal('actual_amount', 12, 2);
            $table->decimal('variance', 12, 2)->nullable(true);
            $table->Timestamp('date')->default(now());
            $table->Timestamp('approval_date')->nullable(true);
            $table->Timestamp('decline_date')->nullable(true);
            $table->Timestamp('disburse_date')->nullable(true);
            $table->foreignId('sent_to');
            $table->foreignId('requested_by');
            $table->foreignId('treated_by');
            $table->string('status', 50)->default("pending");
            $table->text('comment');

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
        Schema::dropIfExists('budgets');
    }
}
