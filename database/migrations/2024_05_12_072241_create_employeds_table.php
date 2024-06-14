<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('employeds', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('tempat_lahir')->nullable();
            $table->date('tgl_lahir')->nullable();
            $table->string('jk')->nullable();
            $table->string('telp')->nullable();
            $table->string('email')->unique();
            $table->string('position');
            $table->string('status')->default(0);
            $table->string('status_woo')->default(0);
            $table->string('role_woo')->nullable();
            $table->unsignedBigInteger('user_id');
            $table->string('file_ktp')->nullable();
            $table->string('file_foto')->nullable();
            $table->string('file_ijazah')->nullable();
            $table->string('file_cv')->nullable();
            $table->string('file_seamanbook')->nullable();
            $table->unsignedBigInteger('wp_id');
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employeds');
    }
};
