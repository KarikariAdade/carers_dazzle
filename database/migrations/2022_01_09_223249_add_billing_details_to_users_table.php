<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddBillingDetailsToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('street_address_1')->nullable();
            $table->string('street_address_2')->nullable();
            $table->integer('town_id')->nullable();
            $table->integer('region_id')->nullable();
            $table->string('country')->nullable();
            $table->string('zip_code')->nullable();
            $table->string('profile_picture')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['street_address_1','street_address_2','town_id','region_id','country','zip_code','profile_picture']);
        });
    }
}
