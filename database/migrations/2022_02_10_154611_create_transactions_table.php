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

            $table->unsignedBigInteger('pool_id')->nullable()->index();
            $table->unsignedBigInteger('contributor_id')->nullable()->index();
            $table->string('txHash')->index();

            $table->integer('account')->nullable();

            $table->string('contributor_account')->nullable();
            $table->decimal('amount', 64, 18)->default(0);
            $table->decimal('commission', 64, 18)->default(0);
            $table->float('fee')->default(0);
            $table->decimal('invested',64, 18)->default(0);

            $table->json('confirmation')->nullable();
            $table->json('collect')->nullable();
            $table->decimal('contributed',64, 18)->default(0);

            $table->text('errors')->nullable();

            $table->string('chainid')->nullable();
            $table->string('currency')->default('ETH');
            $table->enum('destination',['pool','fee'])->default('pool')->index();
            $table->uuid('scope')->index();

            $table->integer('status')->default(1)->index();
            $table->timestamps();

            $table->foreign('pool_id')->references('id')
                ->on('pools')
                ->nullOnDelete()
                ->cascadeOnUpdate();

            $table->foreign('contributor_id')->references('id')->on('users')
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
