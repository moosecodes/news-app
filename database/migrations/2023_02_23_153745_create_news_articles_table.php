<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('news_articles', function (Blueprint $table) {
            $table->id();
            $table->string('api_source')->nullable();

            $table->string('source_id')->nullable();
            $table->integer('favs')->default(0);
            $table->integer('saves')->default(0);
            $table->integer('views')->default(0);
            $table->longText('content')->nullable();
            $table->longText('description')->nullable();
            $table->longText('image_url')->nullable();
            $table->longText('title')->nullable();
            $table->longText('link')->nullable();
            $table->string('author')->nullable();
            $table->string('publishedAt')->nullable();
            $table->string('language')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('news_articles');
    }
};
