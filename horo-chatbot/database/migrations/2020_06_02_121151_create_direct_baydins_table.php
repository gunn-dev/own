<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDirectBaydinsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('direct_baydins', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('birth_date');
            $table->string('nyih_nan');
            $table->string('gender');
            $table->string('address');
            $table->json('services');
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
        Schema::dropIfExists('direct_baydins');
    }
}
