<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOneYearsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('one_years', function (Blueprint $table) {
            $table->increments('id');
            $table->date('birth_date')->nullable();
            $table->string('birth_time')->nullable();
            $table->string('father_name')->nullable();
            $table->string('mother_name')->nullable();
            $table->string('birth_place')->nullable();
            $table->string('nyih_nan')->nullable();
            $table->text('career')->nullable();
            $table->tinyInteger('marital_status')->default(0);
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
        Schema::dropIfExists('one_years');
    }
}
