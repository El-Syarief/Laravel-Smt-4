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
        Schema::create('barang', function (Blueprint $table) {
            $table->id('idBrg');
            $table->unsignedBigInteger('idUser');
            $table->string('fotoBrg', 150);
            $table->string('namaBrg', 100);
            $table->string('kodeBrg', 100)->unique();
            $table->integer('stokBrg')->nullable();
            $table->double('hrgModal', 10)->nullable();
            $table->double('hrgJual', 10)->nullable();
            $table->timestamps();

            $table->foreign('idUser')->references('idUser')->on('user')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('barang');
    }
};
