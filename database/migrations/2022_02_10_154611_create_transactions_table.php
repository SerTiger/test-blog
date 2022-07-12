<?php

use App\Models\Traits\Relation;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionsTable extends Migration
{
    use Relation;
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->decimal('amount', 20, 10);
            $table->unsignedBigInteger('pool_id')->nullable()->index();

            $table->unsignedBigInteger('user_id')->nullable()->index();
            $table->string('txHash');
            $table->integer('account')->nullable();

            $table->integer('status')->default(1);
            $table->timestamps();

            $table->foreign('pool_id')->references('id')
                ->on('pools')
                ->nullOnDelete()
                ->cascadeOnUpdate();

            $table->foreign('user_id')->references('id')->on('users')
                ->nullOnDelete()
                ->cascadeOnUpdate()
                ;
        });

        $this->touch_permission('transactions');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transactions');
    }
}
