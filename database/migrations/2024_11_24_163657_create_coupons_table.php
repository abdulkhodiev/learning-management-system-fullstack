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
        Schema::create('coupons', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('course_id');
            $table->foreign('course_id')->references('id')->on('courses');
            $table->enum('status', ['active', 'inactive'])->default('active');
            $table->string('name');
            $table->string('coupon_code');
            $table->integer('quantity');
            $table->integer('uses_per_customer')->default(1);
            $table->float('discount_amount');
            $table->dateTime(column: 'start_time');
            $table->dateTime(column: 'end_time');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('coupons');
    }
};
