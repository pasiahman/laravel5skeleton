<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCnrTransactions extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cnr_transactions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('reference_number', 50);
            $table->bigInteger('total');
            $table->bigInteger('cnr_cash');
            $table->bigInteger('point');
            $table->bigInteger('user_id');
            $table->string('phone_number', 50);
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
        Schema::dropIfExists('cnr_transactions');
    }
}
