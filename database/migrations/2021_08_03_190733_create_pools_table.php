<?php

use App\Models\Traits\Relation;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePoolsTable extends Migration
{
    use Relation;
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pools', function (Blueprint $table) {
            $table->id();
            $table->string('slug')->unique();
            $table->boolean('status')->default(true);
            $table->integer('position')->default(99999);

            $table->unsignedBigInteger('owner_id')->nullable();
            $table->unsignedBigInteger('company_id')->nullable();

            $table->string('address')->nullable();
            $table->string('network')->default('ETH');
            $table->string('coin')->default('ETH');

            $table->float('amount')->nullable();
            $table->timestampTz('date_start')->nullable();
            $table->timestampTz('date_end')->nullable();

            $table->json('setting_contact')->nullable();
            $table->json('setting_display')->nullable();

            $table->timestamps();

            $table->foreign('owner_id')->references('id')->on('users')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
            $table->foreign('company_id')->references('id')->on('companies')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
        });

        Schema::create('pool_translations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('pool_id');
            $table->string('locale')->index();

            $table->string('title')->nullable();
            $table->text('description')->nullable();
            $table->string('meta_title')->nullable();
            $table->string('meta_keywords')->nullable();
            $table->text('meta_description')->nullable();

            $table->unique(['pool_id', 'locale']);
            $table->foreign('pool_id')->references('id')->on('pools')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
        });

        $this->touch_permission('pools');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pool_translations');
        Schema::dropIfExists('pools');
    }
}
