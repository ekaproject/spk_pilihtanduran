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
    Schema::create('kebutuhan_tanaman', function (Blueprint $table) {
        $table->id();
        // Relasi ke tabel alternatifs
        $table->foreignId('alternatif_id')->constrained('alternatifs')->onDelete('cascade');
        
        // Parameter Nitrogen (N)
        $table->double('min_n');
        $table->double('max_n');
        
        // Parameter Phosphorus (P)
        $table->double('min_p');
        $table->double('max_p');
        
        // Parameter Potassium (K)
        $table->double('min_k');
        $table->double('max_k');
        
        // Parameter Suhu
        $table->double('min_suhu');
        $table->double('max_suhu');
        
        // Parameter Kelembapan
        $table->double('min_kelembapan');
        $table->double('max_kelembapan');
        
        // Parameter pH Tanah (bisa desimal)
        $table->double('min_ph');
        $table->double('max_ph');
        
        // Parameter Curah Hujan
        $table->double('min_hujan');
        $table->double('max_hujan');
        
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kebutuhan_tanamen');
    }
};
