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
        Schema::create('course_registrations', function (Blueprint $table) {
            $table->id();
            $table->string('order_number')->unique();
            $table->string('participants');
            $table->string('noted');
            $table->string('status');
            $table->string('status_payment');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('user_id_approve');
            $table->unsignedBigInteger('user_id_approve');
            $table->timestamps('approve_at');
            $table->timestamps('payment_at');
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade'); // Mengubah referensi
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('course_registrations');
    }
};
