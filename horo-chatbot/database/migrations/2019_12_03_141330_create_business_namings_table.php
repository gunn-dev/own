<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBusinessNamingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('business_namings', function (Blueprint $table) {
            $table->increments('id');
            $table->string('owner_name')->nullable();
            $table->date('birth_date')->nullable();
            $table->string('business_type')->nullable();
            $table->string('address')->nullable();
            $table->string('phone_number')->nullable();
            $table->string('nyih_tha')->nullable();
            $table->integer('category_id')->nullable();
            $table->bigInteger('user_id')->nullable();
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
        Schema::dropIfExists('business_namings');
    }
}
