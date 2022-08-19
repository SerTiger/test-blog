<?php

use App\Models\Traits\Relation;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompaniesTable extends Migration
{
    use Relation;
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('companies', function (Blueprint $table) {
            $table->id();
            $table->boolean('status')->default(true);
            $table->unsignedBigInteger('owner_id');

            $table->string('name')->nullable();
            $table->text('description')->nullable();
            $table->text('logo')->nullable();
            $table->text('website')->nullable();
            $table->string('email')->nullable();

            $table->json('contacts')->nullable();

            $table->timestamps();

            $table->foreign('owner_id')->references('id')
                ->on('users')
                ->cascadeOnDelete()
                ->cascadeOnUpdate();
        });

        Schema::create('company_translations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('company_id');
            $table->string('locale')->index();

            $table->string('meta_title')->nullable();
            $table->string('meta_keywords')->nullable();
            $table->text('meta_description')->nullable();

            $table->unique(['company_id', 'locale']);
            $table->foreign('company_id')->references('id')
                ->on('companies')
                ->cascadeOnDelete()
                ->cascadeOnUpdate();
        });

        $this->touch_permission('companies');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('company_translations');
        Schema::dropIfExists('companies');
        Schema::enableForeignKeyConstraints();
    }
}
