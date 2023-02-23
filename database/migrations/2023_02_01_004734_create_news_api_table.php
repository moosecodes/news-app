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
        Schema::create('news_api_articles', function (Blueprint $table) {
            $table->id();
            $table->integer('favs')->default(0);
            $table->integer('saves')->default(0);
            $table->integer('views')->default(0);
            $table->longText('content')->nullable();
            $table->longText('description')->nullable();
            $table->longText('title')->nullable();
            $table->longText('url')->nullable();
            $table->longText('urlToImage')->nullable();
            $table->string('api_source')->nullable();
            $table->string('author')->nullable();
            $table->string('category')->nullable();
            $table->string('publishedAt')->nullable();
            $table->string('source')->nullable();
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
        Schema::dropIfExists('news_api_articles');
    }
};
