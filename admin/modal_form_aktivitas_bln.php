<?php
require_once 'service/aktivitas_bulanan.php';
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Input Aktivitas Bulanan</title>
    <!-- Bootstrap 5 -->
    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }

        .form-wrapper {
            max-width: 1140px;
            margin: 50px auto;
        }

        .card {
            border-radius: 20px;
        }

        textarea {
            min-height: 100px;
        }
    </style>
</head>
<body>
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0">Form Input Aktivitas Bulanan</h5>
        </div>
        <div class="card-body">
            <form action="" method="POST" enctype="multipart/form-data">
                <div class="row">
                    <!-- Kiri -->
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">No</label>
                            <input type="number" name="no" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Nama Kegiatan</label>
                            <input type="text" name="nama_kegiatan" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Nama Aktivitas</label>
                            <input type="text" name="nama_aktivitas" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Organik</label>
                            <input type="number" name="organik" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Mitra</label>
                            <input type="number" name="mitra" class="form-control" required>
                        </div>
                    </div>

                    <!-- Kanan -->
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">Usulan Anggaran</label>
                            <input type="number" step="0.01" name="usulan_anggaran" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Realisasi Anggaran</label>
                            <input type="number" step="0.01" name="realisasi_anggaran" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Realisasi Kegiatan</label>
                            <textarea name="realisasi_kegiatan" class="form-control" required></textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Kendala</label>
                            <textarea name="kendala" class="form-control" required></textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Solusi</label>
                            <textarea name="solusi" class="form-control" required></textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Input Teks Keterangan</label>
                            <input type="form" name="form-control" class="form-control" required>
                        </div>
                    </div>
                </div>
                <div class="text-center pt-3">
                    <button type="submit" class="btn btn-success px-4">Simpan</button>
                </div>
            </form>
        </div>
    </div>

<!-- Bootstrap JS -->
<script src="../js/bootstrap.bundle.js"></script>
</body>
</html>
