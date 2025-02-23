<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('notifications', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->string('type'); // like, follow, retweet, etc.
            $table->foreignId('actor_id')->constrained('users')->cascadeOnDelete();
            $table->morphs('notifiable'); // Polymorphic relation to tweets, comments, etc.
            $table->text('data')->nullable();
            $table->timestamp('read_at')->nullable();
            $table->string('neon_intensity')->default('high'); // Cyberpunk UI element
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('notifications');
    }
}; 

