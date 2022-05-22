<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterPromotionalBannersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('promotional_banners', function (Blueprint $table) {
            $table->string('footer_message')->nullable();
            $table->string('header_message')->nullable();
            $table->string('content_message')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('promotional_banners', function (Blueprint $table) {
            $table->dropColumn(['footer_message', 'header_message', 'content_message']);
        });
    }
}
