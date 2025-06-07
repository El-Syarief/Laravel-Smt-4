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
        Schema::create('transaksi', function (Blueprint $table) {
            $table->id('idTransaksi');
            $table->unsignedBigInteger('idUser');
            $table->double('totalHrgJual', 15, 2);
            $table->double('totalHrgModal', 15, 2);
            $table->double('uangDibayar', 15, 2);
            $table->double('uangKembalian', 15, 2)->nullable();
            $table->double('laba', 15, 2);
            $table->timestamp('tanggalTransaksi');
            $table->timestamps();

            $table->foreign('idUser')->references('idUser')->on('user')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaksi');
    }
};
