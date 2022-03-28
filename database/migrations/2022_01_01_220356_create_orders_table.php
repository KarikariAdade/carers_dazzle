<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id')->nullable()->unsigned();
            $table->longText('meta')->nullable();
            $table->string('street_address_1')->nullable();
            $table->string('street_address_2')->nullable();
            $table->integer('town_id')->nullable();
            $table->integer('region_id')->nullable();
            $table->string('country')->nullable();
            $table->string('zip_code')->nullable();
            $table->string('name')->nullable();
            $table->string('email')->nullable();
            $table->double('sub_total', 10, 2)->nullable();
            $table->double('discount', 10, 2)->nullable();
            $table->double('shipping', 10, 2)->nullable();
            $table->double('net_total', 10, 2)->nullable();
            $table->string('payment_type')->nullable();
            $table->string('order_id')->nullable();
            $table->integer('invoice_id')->nullable()->unsigned();
            $table->string('order_status')->nullable();
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
        Schema::dropIfExists('orders');
    }
}
