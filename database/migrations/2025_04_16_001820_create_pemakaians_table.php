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
        Schema::create('pemakaians', function (Blueprint $table) {
            $table->id();
            $table->integer('tahun');
            $table->integer('bulan');
            $table->string('no_kontrol');
            $table->foreign('no_kontrol')->references('no_kontrol') ->on('pelanggans') ->onDelete('cascade');
            $table->integer('meter_awal');
            $table->integer('meter_akhir');
            $table->integer('jumlah_pakai');
            $table->integer('biaya_beban_pemakaian');
            $table->integer('biaya_pemakaian');
            $table->integer('total_bayar');
            $table->integer('jumlah_bayar')->nullable();
            // $table->decimal('total_bayar');
            // $table->decimal('jumlah_bayar')->nullable();
            $table->date('tanggal_bayar')->nullable();
            $table->enum('status', ['belum_bayar', 'lunas'])->default('belum_bayar');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pemakaians');
    }
};
