<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddSendToStartPohnePayments extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('star_phone_payments', function (Blueprint $table) {
            $table->tinyInteger('send')->default(0)->after('status');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('star_phone_payments', function (Blueprint $table) {
            Schema::dropIfExists('star_phone_payments');
        });
    }
}
