<?php
include "service/database.php";

if (isset($_POST['oke'])) {
    $kode_program = mysqli_real_escape_string($koneksi, $_POST['kode_program']);
    $kode_kegiatan = mysqli_real_escape_string($koneksi, $_POST['kode_kegiatan']);

    $query = "INSERT INTO tbl_aktivitas (kode_program, kode_kegiatan) VALUES (?, ?)";
    $stmt = mysqli_prepare($koneksi, $query);
    mysqli_stmt_bind_param($stmt, "ss", $kode_program, $kode_kegiatan);

    if (mysqli_stmt_execute($stmt)) {
        echo "<script>alert('Data berhasil disimpan!'); window.location.href='input_aktivitas.php';</script>";
    } else {
        echo "<script>alert('Gagal menyimpan data: " . mysqli_error($koneksi) . "');</script>";
    }

    mysqli_stmt_close($stmt);
}
?>


<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Input Aktivitas</title><!-- Load Bootstrap CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

<!-- Load jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- Load Bootstrap JS (Pastikan di atas script lu) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <link rel="stylesheet" href="css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        body {
            background-color: #7DCDFC;
            font-family: Arial, sans-serif;
        }
        .container-wrapper {
            display: flex;
        }
        .content {
            flex-grow: 1;
            padding: 20px;
            margin-top: 70px;
        }
        .form-container {
            max-width: 400px;
            margin-left: 20px;
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }
        .table-container {
            margin-top: 20px;
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>
<body>
    <?php include "header.php"; ?>
    <div class="container-wrapper">
        <?php include "sidebar.php"; ?>
        <div class="content">
            <div class="form-container">
                <h2>Input Aktivitas</h2>
                <form id="aktivitasForm" method="POST">
                    <div class="mb-3">
                        <label for="kode_program" class="form-label">Program</label>
                        <select id="kode_program" name="kode_program" class="form-select" required>
                            <option value="" disabled selected>Pilih Program</option>
                            <?php 
                            $query = mysqli_query($koneksi, "SELECT * FROM tbl_program1");
                            while ($data = mysqli_fetch_array($query)) {
                                echo "<option value='{$data['kode_program']}'>{$data['kode_program']}</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="kode_kegiatan" class="form-label">Kegiatan</label>
                        <select id="kode_kegiatan" name="kode_kegiatan" class="form-select" required>
                            <option value="" disabled selected>Pilih Kegiatan</option>
                        </select>
                    </div>
                    <div class="d-grid gap-2">
                        <button type="button" id="okeBtn" class="btn btn-primary">OK</button>
                        <button type="reset" class="btn btn-secondary">Cancel</button>
                    </div>
                </form>
            </div>

            <div class="table-container">
                <h3>Kegiatan Terpilih</h3>
                <table class="table table-bordered" id="aktivitasTable">
                        <tr id="noDataRow">
                            <td colspan="4" class="text-center">Belum ada data</td>
                        </tr>
                    </tbody>
                </table>
            </div>

<!-- Modal Tambah -->
<div class="modal fade" id="tambahModal" tabindex="-1" aria-labelledby="tambahModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="tambahModalLabel">Tambah Data</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <?php include "modal_form_aktivitas_bln.php"; ?>
      </div>
    </div>
  </div>
</div>

    <script>
        $(document).ready(function() {
    function loadTable(page = 1) {
        var kode_program = $('#kode_program').val();
        var kode_kegiatan = $('#kode_kegiatan').val();

        if (!kode_program || !kode_kegiatan) {
            alert("Silakan pilih program dan kegiatan!");
            return;
        }

        $.ajax({
            url: 'get_ro.php',
            method: 'POST',
            data: { kode_program: kode_program, kode_kegiatan: kode_kegiatan, page: page },
            success: function(response) {
                $('#aktivitasTable').html(response);
            }
        });
    }

    $('#kode_program').change(function() {
        var kode_program = $(this).val();
        $.ajax({
            url: 'get_kegiatan.php',
            method: 'POST',
            data: { kode_program: kode_program },
            success: function(response) {
                $('#kode_kegiatan').html(response);
            }
        });
    });

    $('#okeBtn').click(function() {
        loadTable();
    });

    // Pagination Click
    $(document).on('click', '.pagination-link', function(e) {
        e.preventDefault();
        var page = $(this).data('page');
        loadTable(page);
    });

    // Tambah Data
    $(document).on('click', '.tambahBtn', function() {
        var id = $(this).data('id');
        $('#tambahModal').modal('show');
        $('#tambahModalLabel').text('Tambah Data untuk ID: ' + id);
        // Di sini lu bisa load modal tambah dan ambil data
    });

    // Edit Data
    $(document).on('click', '.editBtn', function() {
        var id = $(this).data('id');
        alert('Edit data dengan ID: ' + id);
        // Di sini lu bisa load modal edit dan ambil data
    });

    // Hapus Data
    $(document).on('click', '.deleteBtn', function() {
        var id = $(this).data('id');
        if (confirm('Yakin mau hapus data ini?')) {
            $.ajax({
                url: 'delete_ro.php',
                method: 'POST',
                data: { id: id },
                success: function(response) {
                    alert(response);
                    loadTable();
                }
            });
        }
    });
});


    </script>
    <script src="js/bootstrap.bundle.min.js"></script>
</body>
</html>
