<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLoveBayDinsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('love_bay_dins', function (Blueprint $table) {
            $table->increments('id');
            $table->string('g_name')->nullable();
            $table->string('b_name')->nullable();
            $table->string('g_birth_day')->nullable();
            $table->string('b_birth_day')->nullable();
            $table->string('g_birth_date')->nullable();
            $table->string('b_birth_date')->nullable();
            $table->string('g_address')->nullable();
            $table->string('b_address')->nullable();
            $table->string('phone_number')->nullable();
            $table->string('user_id')->nullable();
            $table->string('order_id')->nullable();
            $table->bigInteger('category_id')->nullable();
            $table->tinyInteger('is_delivered')->nullable()->default(0);
            $table->tinyInteger('status')->nullable()->default(0);
            $table->tinyInteger('payment_status')->nullable()->default(0);
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
        Schema::dropIfExists('love_bay_dins');
    }
}
