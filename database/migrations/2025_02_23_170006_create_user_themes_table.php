<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('user_themes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->string('primary_color')->default('#FF00FF'); // Default neon pink
            $table->string('secondary_color')->default('#00FFFF'); // Default cyan
            $table->string('background_image_path')->nullable();
            $table->string('profile_neon_effect')->default('pulse'); // Animation effect
            $table->boolean('dark_mode')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('user_themes');
    }
}; 