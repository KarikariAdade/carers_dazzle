<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSususTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('susus', function (Blueprint $table) {
            $table->id();
            $table->string('user_id');
            $table->string('susu_number')->nullable();
            $table->string('shipping')->nullable();
            $table->string('discount_type')->nullable();
            $table->string('discount_amount')->nullable();
            $table->string('discount_total')->nullable();
            $table->string('sub_total')->nullable();
            $table->string('net_total')->nullable();
            $table->string('remarks')->nullable();
            $table->string('amount_paid')->nullable();
            $table->string('payment_interval')->nullable();
            $table->string('payment_status')->nullable();
            $table->date('expected_full_payment')->nullable();
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
        Schema::dropIfExists('susus');
    }
}
