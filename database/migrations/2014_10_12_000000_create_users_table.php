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
        Schema::create('user', function (Blueprint $table) {
            $table->id('idUser');
            $table->string('namaUsaha', 100)->nullable();
            $table->string('email', 100)->unique();
            $table->string('password', 255);
            $table->string('noTelp', 20)->nullable();
            $table->string('alamat', 255)->nullable();
            $table->string('foto', 255)->nullable();
            $table->string('qrCode', 255)->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user');
    }
};
