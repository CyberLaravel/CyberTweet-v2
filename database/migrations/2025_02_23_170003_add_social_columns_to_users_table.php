<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('username')->unique()->after('email');
            $table->text('bio')->nullable()->after('username');
            $table->string('location')->nullable()->after('bio');
            $table->string('website')->nullable()->after('location');
            $table->date('birth_date')->nullable()->after('website');
            $table->integer('followers_count')->default(0)->after('birth_date');
            $table->integer('following_count')->default(0)->after('followers_count');
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'username', 
                'bio', 
                'location', 
                'website', 
                'birth_date', 
                'followers_count', 
                'following_count'
            ]);
        });
    }
}; 