<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SpkSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Data Kriteria
        DB::table('kriterias')->insert([
            ['kode_kriteria' => 'C1', 'nama_kriteria' => 'Nitrogen (N)', 'bobot' => 0.15, 'jenis' => 'Benefit', 'satuan' => 'mg/kg'],
            ['kode_kriteria' => 'C2', 'nama_kriteria' => 'Phosphorus (P)', 'bobot' => 0.15, 'jenis' => 'Benefit', 'satuan' => 'mg/kg'],
            ['kode_kriteria' => 'C3', 'nama_kriteria' => 'Potassium (K)', 'bobot' => 0.15, 'jenis' => 'Benefit', 'satuan' => 'mg/kg'],
            ['kode_kriteria' => 'C4', 'nama_kriteria' => 'Suhu', 'bobot' => 0.10, 'jenis' => 'Benefit', 'satuan' => '°C'],
            ['kode_kriteria' => 'C5', 'nama_kriteria' => 'Kelembapan', 'bobot' => 0.10, 'jenis' => 'Benefit', 'satuan' => '%'],
            ['kode_kriteria' => 'C6', 'nama_kriteria' => 'pH Tanah', 'bobot' => 0.20, 'jenis' => 'Benefit', 'satuan' => 'pH'],
            ['kode_kriteria' => 'C7', 'nama_kriteria' => 'Curah Hujan', 'bobot' => 0.15, 'jenis' => 'Benefit', 'satuan' => 'mm'],
        ]);

        // 2. Data Alternatif
        DB::table('alternatifs')->insert([
            ['id' => 1, 'kode_alternatif' => 'A1', 'nama_tanaman' => 'Padi'],
            ['id' => 2, 'kode_alternatif' => 'A2', 'nama_tanaman' => 'Jagung'],
            ['id' => 3, 'kode_alternatif' => 'A3', 'nama_tanaman' => 'Kedelai'],
            ['id' => 4, 'kode_alternatif' => 'A4', 'nama_tanaman' => 'Kacang tanah'],
            ['id' => 5, 'kode_alternatif' => 'A5', 'nama_tanaman' => 'Kacang hijau'],
            ['id' => 6, 'kode_alternatif' => 'A6', 'nama_tanaman' => 'Cabai'],
            ['id' => 7, 'kode_alternatif' => 'A7', 'nama_tanaman' => 'Bawang merah'],
        ]);

        // 3. Data Kebutuhan Tanaman (Rule Base)
        DB::table('kebutuhan_tanaman')->insert([
            ['alternatif_id' => 1, 'min_n' => 60, 'max_n' => 100, 'min_p' => 35, 'max_p' => 60, 'min_k' => 35, 'max_k' => 55, 'min_suhu' => 20, 'max_suhu' => 35, 'min_kelembapan' => 75, 'max_kelembapan' => 100, 'min_ph' => 5.5, 'max_ph' => 7.0, 'min_hujan' => 150, 'max_hujan' => 300],
            ['alternatif_id' => 2, 'min_n' => 60, 'max_n' => 100, 'min_p' => 35, 'max_p' => 60, 'min_k' => 35, 'max_k' => 55, 'min_suhu' => 18, 'max_suhu' => 30, 'min_kelembapan' => 50, 'max_kelembapan' => 70, 'min_ph' => 5.5, 'max_ph' => 7.5, 'min_hujan' => 60, 'max_hujan' => 120],
            ['alternatif_id' => 3, 'min_n' => 20, 'max_n' => 60, 'min_p' => 35, 'max_p' => 60, 'min_k' => 35, 'max_k' => 55, 'min_suhu' => 20, 'max_suhu' => 30, 'min_kelembapan' => 60, 'max_kelembapan' => 80, 'min_ph' => 5.8, 'max_ph' => 7.0, 'min_hujan' => 50, 'max_hujan' => 100],
            ['alternatif_id' => 4, 'min_n' => 20, 'max_n' => 60, 'min_p' => 20, 'max_p' => 50, 'min_k' => 20, 'max_k' => 50, 'min_suhu' => 25, 'max_suhu' => 30, 'min_kelembapan' => 50, 'max_kelembapan' => 70, 'min_ph' => 5.5, 'max_ph' => 7.0, 'min_hujan' => 50, 'max_hujan' => 100],
            ['alternatif_id' => 5, 'min_n' => 20, 'max_n' => 40, 'min_p' => 30, 'max_p' => 50, 'min_k' => 20, 'max_k' => 40, 'min_suhu' => 25, 'max_suhu' => 35, 'min_kelembapan' => 60, 'max_kelembapan' => 85, 'min_ph' => 5.8, 'max_ph' => 7.0, 'min_hujan' => 40, 'max_hujan' => 80],
            ['alternatif_id' => 6, 'min_n' => 40, 'max_n' => 80, 'min_p' => 30, 'max_p' => 60, 'min_k' => 30, 'max_k' => 60, 'min_suhu' => 20, 'max_suhu' => 30, 'min_kelembapan' => 60, 'max_kelembapan' => 80, 'min_ph' => 6.0, 'max_ph' => 7.0, 'min_hujan' => 60, 'max_hujan' => 120],
            ['alternatif_id' => 7, 'min_n' => 30, 'max_n' => 60, 'min_p' => 20, 'max_p' => 50, 'min_k' => 20, 'max_k' => 50, 'min_suhu' => 25, 'max_suhu' => 32, 'min_kelembapan' => 60, 'max_kelembapan' => 80, 'min_ph' => 6.0, 'max_ph' => 7.0, 'min_hujan' => 40, 'max_hujan' => 80],
        ]);
    }
}