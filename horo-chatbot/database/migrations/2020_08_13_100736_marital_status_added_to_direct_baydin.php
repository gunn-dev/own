<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MaritalStatusAddedToDirectBaydin extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('direct_baydins', function (Blueprint $table) {
            $table->string('marital_status')->nullable()->after('about');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('direct_baydins', function (Blueprint $table) {
            Schema::dropIfExists('direct_baydins');
        });
    }
}
