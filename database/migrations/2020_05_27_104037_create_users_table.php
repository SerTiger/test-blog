<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('surname')->nullable();
            $table->text('avatar')->nullable();

            $table->string('auth_address')->index()->nullable();

            $table->string('phone')->nullable();
            $table->string('country')->nullable();
            $table->string('country_code')->nullable();
            $table->string('city')->nullable();
            $table->string('city_code')->nullable();

            $table->datetime('verified_at')->nullable();

            $table->date('birthday')->nullable();
            $table->json('contacts')->nullable();

            $table->decimal('contributed', 64, 18)->default(0);
            $table->decimal('contributed_usd', 16, 2)->default(0);
            $table->decimal('invested', 64, 18)->default(0);
            $table->decimal('invested_usd', 16, 2)->default(0);

            $table->string('password')->nullable();
            $table->string('remember_token')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->unique('auth_address');
        });

        Schema::create('wallets', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');

            $table->string('address')->index();
            $table->string('chainid')->nullable();
            $table->string('currency')->nullable();
            $table->string('network')->nullable();

            $table->timestamps();
            $table->softDeletes();

            $table->unique(['user_id', 'address']);
            $table->foreign('user_id')->references('id')
                ->on('users')
                ->cascadeOnDelete()
                ->cascadeOnUpdate();
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('wallets');
        Schema::dropIfExists('users');
    }
}
