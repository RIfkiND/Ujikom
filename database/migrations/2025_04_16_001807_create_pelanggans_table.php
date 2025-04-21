<?php

use App\Models\Tarif;
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
        Schema::create('pelanggans', function (Blueprint $table) {
            $table->string('no_kontrol')->primary();
            $table->string('name');
            $table->string('alamat');
            $table->string('no_telepon');
            $table->foreignIdFor(Tarif::class, 'jenis_plg')->constrained('tarifs')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pelanggans');
    }
};
