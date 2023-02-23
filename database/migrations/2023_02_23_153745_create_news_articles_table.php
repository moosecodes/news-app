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
            $table->boolean('is_opinion')->nullable();
            $table->integer('_score')->nullable();
            $table->integer('favs')->default(0);
            $table->integer('saves')->default(0);
            $table->integer('views')->default(0);
            $table->integer('rank')->nullable();
            $table->longText('content')->nullable();
            $table->longText('description')->nullable();
            $table->longText('excerpt')->nullable();
            $table->longText('image_url')->nullable();
            $table->longText('link')->nullable();
            $table->longText('media')->nullable();
            $table->longText('summary')->nullable();
            $table->longText('title')->nullable();
            $table->longText('url')->nullable();
            $table->longText('urlToImage')->nullable();
            $table->string('_id')->nullable();
            $table->string('api_source')->nullable();
            $table->string('author')->nullable();
            $table->string('authors')->nullable();
            $table->string('category')->nullable();
            $table->string('clean_url')->nullable();
            $table->string('country')->nullable();
            $table->string('creator')->nullable();
            $table->string('keywords')->nullable();
            $table->string('language')->nullable();
            $table->string('pubDate')->nullable();
            $table->string('publishedAt')->nullable();
            $table->string('published_date')->nullable();
            $table->string('published_date_precision')->nullable();
            $table->string('rights')->nullable();
            $table->string('source')->nullable();
            $table->string('source_id')->nullable();
            $table->string('topic')->nullable();
            $table->string('twitter_account')->nullable();
            $table->string('video_url')->nullable();
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
