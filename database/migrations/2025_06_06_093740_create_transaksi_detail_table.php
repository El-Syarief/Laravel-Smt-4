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
        Schema::create('transaksi_detail', function (Blueprint $table) {
            $table->id('idDetail');
            $table->unsignedBigInteger('idTransaksi');
            $table->unsignedBigInteger('idBrg');
            $table->integer('jumlah');
            $table->double('hrgJualSatuan', 15, 2);
            $table->double('hrgModalSatuan', 15, 2);
            $table->timestamps();

            $table->foreign('idTransaksi')->references('idTransaksi')->on('transaksi')->onDelete('cascade');
            $table->foreign('idBrg')->references('idBrg')->on('barang')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaksi_detail');
    }
};
