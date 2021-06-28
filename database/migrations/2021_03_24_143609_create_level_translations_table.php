<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLevelTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('level_translations', function (Blueprint $table) {
            $table->id();

            $table->string('locale')->index();
            
            // Foreign key to the main model
            $table->unsignedBigInteger('level_id');
            $table->unique(['level_id', 'locale']);
            $table->foreign('level_id')->references('id')->on('levels')->onDelete('cascade');

            // Actual fields you want to translate
            $table->string('title')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('level_translations');
    }
}
