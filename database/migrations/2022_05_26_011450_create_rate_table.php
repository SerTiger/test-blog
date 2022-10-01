<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRateTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(
            'exchange_rates',
            function (Blueprint $table) {
                $table->increments('id');
                $table->string('currency', 10)->index();
                $table->double('rate',64,18,true)->default(1.00);
                $table->string('symbol', 5)->nullable();
                $table->string('type', 10)->nullable();
                $table->string('slug', 255)->nullable();

                $table->timestamps();
            }
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('exchange_rates');
    }
}
