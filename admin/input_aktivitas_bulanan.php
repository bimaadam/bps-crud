<?php
include "service/database.php";
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aktivitas Bulanan</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
     <style>
        .container-wrapper {
            display: flex;
        }
        .content {
            flex-grow: 1;
            padding: 20px;
        }
    </style>
</head>
<?php include "header.php"; ?>
<body>
    <div class="container-wrapper">
    <?php include "sidebar.php" ?>
    <div class="container mt-5">
        <h2 class="text-center">Input Aktivitas Bulanan</h2>
        <form id="formAktivitas" method="POST">
            <!-- Input Nomor -->
            <div class="mb-3">
                <label for="nomor" class="form-label">Nomor</label>
                <input type="text" id="nomor" name="nomor" class="form-control" required>
            </div>
            
            <!-- Select Aktivitas -->
            <div class="mb-3">
                <label for="aktivitas" class="form-label">Pilih Aktivitas</label>
                <select id="aktivitas" name="aktivitas" class="form-select" required>
                    <option value="" disabled selected>Pilih Aktivitas</option>
                    <?php 
                    $query = mysqli_query($koneksi, "SELECT * FROM aktivitas");
                    while ($data = mysqli_fetch_array($query)) {
                        echo "<option value='{$data['id']}'>{$data['nama_aktivitas']}</option>";
                    }
                    ?>
                </select>
            </div>
            
            <!-- Tampilkan Data Aktivitas -->
            <div id="dataAktivitas" class="mt-3"></div>
            
            <!-- Tombol Submit -->
            <button type="submit" class="btn btn-primary">Simpan</button>
        </form>
    </div>

    <script>
        $(document).ready(function() {
            $('#aktivitas').change(function() {
                var id = $(this).val();
                if (id) {
                    $.ajax({
                        url: 'get_aktivitas.php',
                        type: 'POST',
                        data: { id: id },
                        success: function(response) {
                            $('#dataAktivitas').html(response);
                        }
                    });
                } else {
                    $('#dataAktivitas').html('');
                }
            });
        });
    </script>
</body>
</html>