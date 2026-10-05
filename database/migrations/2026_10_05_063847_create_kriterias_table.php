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
    Schema::create('kriterias', function (Blueprint $table) {
        $table->id();
        $table->string('kode_kriteria', 5)->unique();   // Contoh: C1, C2
        $table->string('nama_kriteria', 50);            // Contoh: Nitrogen (N)
        $table->double('bobot');                        // Contoh: 0.15
        $table->string('jenis', 10)->default('Benefit');// Benefit / Cost
        $table->string('satuan', 20)->nullable();       // Contoh: mg/kg, °C
        $table->timestamps();
    });
}
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kriterias');
    }
};
