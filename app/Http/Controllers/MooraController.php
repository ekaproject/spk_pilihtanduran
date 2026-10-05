<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MooraController extends Controller
{
    // Menampilkan halaman form input
    public function index()
    {
        return view('spk.index');
    }

    // Memproses perhitungan MOORA
    public function hitung(Request $request)
    {
        // 1. Ambil data dari database
        $kriterias = DB::table('kriterias')->get();
        $alternatifs = DB::table('alternatifs')->get();
        $rules = DB::table('kebutuhan_tanaman')->get()->keyBy('alternatif_id');

        // Input dari user
        $input = [
            'C1' => $request->n,
            'C2' => $request->p,
            'C3' => $request->k,
            'C4' => $request->suhu,
            'C5' => $request->kelembapan,
            'C6' => $request->ph,
            'C7' => $request->hujan,
        ];

        // 2. TAHAP 1: Matriks Kesesuaian (X)
        $matriks_x = [];
        foreach ($alternatifs as $alt) {
            $rule = $rules[$alt->id];
            $matriks_x[$alt->id] = [
                'C1' => $this->hitungSkor($input['C1'], $rule->min_n, $rule->max_n),
                'C2' => $this->hitungSkor($input['C2'], $rule->min_p, $rule->max_p),
                'C3' => $this->hitungSkor($input['C3'], $rule->min_k, $rule->max_k),
                'C4' => $this->hitungSkor($input['C4'], $rule->min_suhu, $rule->max_suhu),
                'C5' => $this->hitungSkor($input['C5'], $rule->min_kelembapan, $rule->max_kelembapan),
                'C6' => $this->hitungSkor($input['C6'], $rule->min_ph, $rule->max_ph),
                'C7' => $this->hitungSkor($input['C7'], $rule->min_hujan, $rule->max_hujan),
            ];
        }

        // 3. TAHAP 2: Normalisasi Matriks (X*)
        // Cari pembagi (akar dari jumlah kuadrat tiap kolom kriteria)
        $pembagi = [];
        foreach ($kriterias as $k) {
            $jumlah_kuadrat = 0;
            foreach ($alternatifs as $alt) {
                $jumlah_kuadrat += pow($matriks_x[$alt->id][$k->kode_kriteria], 2);
            }
            $pembagi[$k->kode_kriteria] = sqrt($jumlah_kuadrat);
        }

        $matriks_normalisasi = [];
        foreach ($alternatifs as $alt) {
            foreach ($kriterias as $k) {
                $nilai = $matriks_x[$alt->id][$k->kode_kriteria];
                $matriks_normalisasi[$alt->id][$k->kode_kriteria] = $pembagi[$k->kode_kriteria] != 0 ? $nilai / $pembagi[$k->kode_kriteria] : 0;
            }
        }

        // 4. TAHAP 3: Pembobotan & TAHAP 4: Nilai Optimasi (Yi)
        $hasil_akhir = [];
        foreach ($alternatifs as $alt) {
            $yi = 0;
            $matriks_bobot = [];
            foreach ($kriterias as $k) {
                $nilai_bobot = $matriks_normalisasi[$alt->id][$k->kode_kriteria] * $k->bobot;
                $matriks_bobot[$k->kode_kriteria] = $nilai_bobot;
                
                // Karena semua benefit, langsung dijumlahkan
                $yi += $nilai_bobot; 
            }

            $hasil_akhir[] = [
                'nama_tanaman' => $alt->nama_tanaman,
                'matriks_x' => $matriks_x[$alt->id],
                'matriks_normalisasi' => $matriks_normalisasi[$alt->id],
                'matriks_bobot' => $matriks_bobot,
                'nilai_yi' => $yi
            ];
        }

        // Urutkan dari nilai Yi terbesar ke terkecil (Perangkingan)
        usort($hasil_akhir, function($a, $b) {
            return $b['nilai_yi'] <=> $a['nilai_yi'];
        });

        // Kirim semua data ke halaman hasil
        return view('spk.hasil', compact('kriterias', 'alternatifs', 'hasil_akhir', 'input'));
    }

    // Fungsi bantuan: Mengubah nilai aktual menjadi nilai kesesuaian (0-100)
    private function hitungSkor($input, $min, $max)
    {
        if ($input >= $min && $input <= $max) {
            return 100; // Sangat Sesuai
        } else {
            // Jika di luar rentang, nilainya berkurang berdasarkan selisih
            $rata_rata = ($min + $max) / 2;
            $selisih = abs($input - $rata_rata);
            $skor = 100 - (($selisih / $rata_rata) * 100);
            return $skor > 0 ? round($skor, 2) : 10; // Minimal skor 10 agar tidak error dibagi 0
        }
    }
}