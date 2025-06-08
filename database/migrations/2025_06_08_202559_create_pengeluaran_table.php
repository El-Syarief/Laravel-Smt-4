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
        Schema::create('pengeluaran', function (Blueprint $table) {
            $table->id('idPengeluaran');
            $table->foreignId('idUser')->constrained('user', 'idUser')->onDelete('cascade');
            $table->string('deskripsi');
            $table->decimal('jumlah', 15, 2);
            $table->timestamp('tanggal');
        
            $table->unsignedBigInteger('idBrg')->nullable();
            $table->foreign('idBrg')->references('idBrg')->on('barang')->onDelete('set null');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengeluaran');
    }
};
