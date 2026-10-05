<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hasil Rekomendasi - MOORA</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light pb-5">
    <nav class="navbar navbar-dark bg-success mb-4">
        <div class="container">
            <span class="navbar-brand mb-0 h1">🌾 SPK Rekomendasi Tanaman (MOORA)</span>
            <a href="{{ url('/') }}" class="btn btn-outline-light btn-sm">Kembali</a>
        </div>
    </nav>

    <div class="container">
        <!-- 1. Form Luaran Perangkingan (Top 3 Cards) -->
        <h4 class="mb-3">Top 3 Rekomendasi Tanaman</h4>
        <div class="row mb-4">
            @foreach(array_slice($hasil_akhir, 0, 3) as $index => $hasil)
                <div class="col-md-4">
                    <div class="card text-center shadow-sm border-{{ $index == 0 ? 'warning' : ($index == 1 ? 'secondary' : 'danger') }} border-2">
                        <div class="card-header bg-{{ $index == 0 ? 'warning' : ($index == 1 ? 'secondary' : 'danger') }} text-white fw-bold">
                            Peringkat {{ $index + 1 }}
                        </div>
                        <div class="card-body">
                            <h3 class="card-title">{{ $hasil['nama_tanaman'] }}</h3>
                            <p class="card-text text-muted">Nilai Optimasi (Yi): <br> <strong>{{ number_format($hasil['nilai_yi'], 4) }}</strong></p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Tabel Lengkap 7 Alternatif -->
        <div class="card shadow-sm mb-4">
            <div class="card-header bg-white fw-bold">Hasil Perangkingan Keseluruhan</div>
            <div class="card-body p-0">
                <table class="table table-striped table-hover mb-0 text-center">
                    <thead class="table-dark">
                        <tr>
                            <th>Peringkat</th>
                            <th>Alternatif Tanaman</th>
                            <th>Nilai MOORA (Yi)</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($hasil_akhir as $index => $hasil)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td class="fw-bold">{{ $hasil['nama_tanaman'] }}</td>
                            <td>{{ number_format($hasil['nilai_yi'], 4) }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <!-- 2. Form Hasil Analisis (Tabel Kesesuaian) -->
        <div class="card shadow-sm mb-4">
            <div class="card-header bg-white fw-bold">Matriks Kesesuaian (0-100)</div>
            <div class="card-body p-0 table-responsive">
                <table class="table table-bordered mb-0 text-center text-nowrap">
                    <thead class="table-light">
                        <tr>
                            <th>Tanaman</th>
                            @foreach($kriterias as $k)
                                <th>{{ $k->kode_kriteria }}</th>
                            @endforeach
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($hasil_akhir as $hasil)
                        <tr>
                            <td class="text-start fw-bold">{{ $hasil['nama_tanaman'] }}</td>
                            @foreach($kriterias as $k)
                                <td>{{ $hasil['matriks_x'][$k->kode_kriteria] }}</td>
                            @endforeach
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <!-- 3. Form Laporan Perhitungan MOORA (Accordion) -->
        <div class="accordion shadow-sm" id="accordionMoora">
            <div class="accordion-item">
                <h2 class="accordion-header">
                    <button class="accordion-button collapsed fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#collapseSatu">
                        Laporan: Matriks Ternormalisasi
                    </button>
                </h2>
                <div id="collapseSatu" class="accordion-collapse collapse" data-bs-parent="#accordionMoora">
                    <div class="accordion-body p-0 table-responsive">
                        <table class="table table-bordered mb-0 text-center text-nowrap">
                            <thead class="table-light">
                                <tr>
                                    <th>Tanaman</th>
                                    @foreach($kriterias as $k) <th>{{ $k->kode_kriteria }}</th> @endforeach
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($hasil_akhir as $hasil)
                                <tr>
                                    <td class="text-start fw-bold">{{ $hasil['nama_tanaman'] }}</td>
                                    @foreach($kriterias as $k)
                                        <td>{{ number_format($hasil['matriks_normalisasi'][$k->kode_kriteria], 4) }}</td>
                                    @endforeach
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            
            <div class="accordion-item">
                <h2 class="accordion-header">
                    <button class="accordion-button collapsed fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#collapseDua">
                        Laporan: Matriks Pembobotan
                    </button>
                </h2>
                <div id="collapseDua" class="accordion-collapse collapse" data-bs-parent="#accordionMoora">
                    <div class="accordion-body p-0 table-responsive">
                        <table class="table table-bordered mb-0 text-center text-nowrap">
                            <thead class="table-light">
                                <tr>
                                    <th>Tanaman</th>
                                    @foreach($kriterias as $k) <th>{{ $k->kode_kriteria }}</th> @endforeach
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($hasil_akhir as $hasil)
                                <tr>
                                    <td class="text-start fw-bold">{{ $hasil['nama_tanaman'] }}</td>
                                    @foreach($kriterias as $k)
                                        <td>{{ number_format($hasil['matriks_bobot'][$k->kode_kriteria], 4) }}</td>
                                    @endforeach
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>