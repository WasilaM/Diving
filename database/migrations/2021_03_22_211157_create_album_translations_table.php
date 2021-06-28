<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAlbumTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('album_translations', function (Blueprint $table) {
            $table->id();

            $table->string('locale')->index();
            
            // Foreign key to the main model
            $table->unsignedBigInteger('album_id');
            $table->unique(['album_id', 'locale']);
            $table->foreign('album_id')->references('id')->on('albums')->onDelete('cascade');

            // Actual fields you want to translate
            $table->string('title')->nullable();
            $table->string('slug')->nullable();
            $table->longText('description')->nullable();
            $table->string('metaData')->nullable();
            $table->string('metaDescription')->nullable();
            $table->string('keywords')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('album_translations');
    }
}
