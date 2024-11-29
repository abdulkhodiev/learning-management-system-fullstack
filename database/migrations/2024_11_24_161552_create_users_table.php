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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('email')->unique();
            $table->string('username')->unique();
            $table->string('password');
            $table->string('role')->default('student');
            $table->string('image', 500)->nullable(); // Increased length
            $table->string('language')->default('en');
            $table->text('description')->nullable(); // Changed to `text`
            $table->string('youtube', 500)->nullable(); // Increased length
            $table->string('x')->nullable();
            $table->string('website', 500)->nullable(); // Increased length
            $table->string('linkedin', 500)->nullable(); // Increased length
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
