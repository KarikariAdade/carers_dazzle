<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSusuItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('susu_items', function (Blueprint $table) {
            $table->id();
            $table->string('susu_id')->nullable();
            $table->integer('product_id')->nullable();
            $table->string('row_sub_total')->nullable();
            $table->string('quantity')->nullable();
            $table->string('price')->nullable();
            $table->longText('description')->nullable();
            $table->string('max_quantity')->nullable();
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
        Schema::dropIfExists('susu_items');
    }
}
