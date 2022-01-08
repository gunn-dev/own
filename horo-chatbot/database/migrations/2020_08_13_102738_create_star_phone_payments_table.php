<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStarPhonePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('star_phone_payments', function (Blueprint $table) {
            $table->increments('id');
            $table->bigInteger('price');
            $table->string('order_id');
            $table->tinyInteger('status')->default(0);
            $table->string('payment_method')->nullable();
            $table->string('type')->nullable();
            $table->tinyInteger('notify')->default(0);
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
        Schema::dropIfExists('star_phone_payments');
    }
}
