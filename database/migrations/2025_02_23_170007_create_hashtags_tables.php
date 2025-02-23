<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('hashtags', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->integer('tweets_count')->default(0);
            $table->timestamps();
        });

        Schema::create('hashtag_tweet', function (Blueprint $table) {
            $table->id();
            $table->foreignId('hashtag_id')->constrained()->cascadeOnDelete();
            $table->foreignId('tweet_id')->constrained()->cascadeOnDelete();
            $table->unique(['hashtag_id', 'tweet_id']);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('hashtag_tweet');
        Schema::dropIfExists('hashtags');
    }
}; 