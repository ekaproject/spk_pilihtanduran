<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SPK Rekomendasi Tanaman - MOORA</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <nav class="navbar navbar-dark bg-success mb-4">
        <div class="container">
            <span class="navbar-brand mb-0 h1">🌾 SPK Rekomendasi Tanaman (MOORA)</span>
        </div>
    </nav>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow-sm">
                    <div class="card-header bg-white">
                        <h5 class="mb-0">Form Input Parameter Lahan</h5>
                    </div>
                    <div class="card-body">
                        <p class="text-muted">Masukkan kondisi lahan aktual Anda untuk mendapatkan rekomendasi tanaman terbaik.</p>
                        
                        <form action="{{ route('spk.hitung') }}" method="POST">
                            @csrf
                            <div class="row mb-3">
                                <div class="col-md-4">
                                    <label class="form-label">Nitrogen (N) - mg/kg</label>
                                    <input type="number" step="any" name="n" class="form-control" required value="80">
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label">Phosphorus (P) - mg/kg</label>
                                    <input type="number" step="any" name="p" class="form-control" required value="40">
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label">Potassium (K) - mg/kg</label>
                                    <input type="number" step="any" name="k" class="form-control" required value="40">
                                </div>
                            </div>
                            
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label class="form-label">Suhu Lingkungan (°C)</label>
                                    <input type="number" step="any" name="suhu" class="form-control" required value="25">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Kelembapan Udara (%)</label>
                                    <input type="number" step="any" name="kelembapan" class="form-control" required value="75">
                                </div>
                            </div>

                            <div class="row mb-4">
                                <div class="col-md-6">
                                    <label class="form-label">pH Tanah</label>
                                    <input type="number" step="any" name="ph" class="form-control" required value="6.5">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Curah Hujan (mm)</label>
                                    <input type="number" step="any" name="hujan" class="form-control" required value="180">
                                </div>
                            </div>

                            <button type="submit" class="btn btn-success w-100 p-2 fw-bold">Proses Rekomendasi MOORA</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>