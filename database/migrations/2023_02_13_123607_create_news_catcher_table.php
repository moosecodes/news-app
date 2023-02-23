<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('news_catcher_articles', function (Blueprint $table) {
            $table->id();
            $table->boolean('is_opinion')->nullable();
            $table->integer('_score')->nullable();
            $table->integer('favs')->default(0);
            $table->integer('rank')->nullable();
            $table->integer('saves')->default(0);
            $table->integer('views')->default(0);
            $table->longText('excerpt')->nullable();
            $table->longText('link')->nullable();
            $table->longText('media')->nullable();
            $table->longText('summary')->nullable();
            $table->string('_id')->nullable();
            $table->string('api_source')->nullable();
            $table->string('author')->nullable();
            $table->string('authors')->nullable();
            $table->string('clean_url')->nullable();
            $table->string('country')->nullable();
            $table->string('language')->nullable();
            $table->string('published_date')->nullable();
            $table->string('published_date_precision')->nullable();
            $table->string('rights')->nullable();
            $table->string('title')->nullable();
            $table->string('topic')->nullable();
            $table->string('twitter_account')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('news_catcher_articles');
    }
};
