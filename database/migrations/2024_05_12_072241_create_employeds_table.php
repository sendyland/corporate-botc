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
            $table->string('tempat_lahir');
            $table->date('tgl_lahir');
            $table->string('jk');
            $table->string('telp');
            $table->string('email')->unique();
            $table->string('position');
            $table->string('status');
            $table->string('status_woo');
            $table->string('role_woo');
            $table->unsignedBigInteger('user_id');
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade'); // Mengubah referensi
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
