<?php 
include "service/database.php";
if(isset($_POST["simpan"])){
    $kode_program = $_POST["kode_program"];
    $uraian_program = $_POST["uraian_program"];

    $sql = "INSERT INTO tbl_program1 (kode_program, uraian_program) VALUES ('$kode_program', '$uraian_program')";

    if($koneksi->query($sql)) {
        echo "<script>alert('Data berhasil disimpan!'); window.location.href='input_program.php';</script>";
    } else {
        echo "<script>alert('Data gagal disimpan!');</script>";
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Program</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <style>
        body {
            background-color: #7DCDFC; /* Warna biru soft */
            margin: 0;
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
            max-width: 500px;
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }
        .table-container {
            max-width: 500px;
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }
        .form-container h2 {
            font-weight: bold;
            text-align: center;
        }
    </style>
</head>
<body>

    <!-- Header -->
    <?php include "header.php"; ?>

    <div class="container-wrapper">
        <!-- Sidebar -->
        <?php include "sidebar.php"; ?>

        <!-- Konten -->
        <div class="content">
            <div class="form-container">
                <h2>Tambah Program</h2>
                <form action="input_program.php" method="POST">
                    <div class="mb-3">
                        <label for="kode_program" class="form-label">Kode Program</label>
                        <input type="text" class="form-control" id="kode_program" name="kode_program" placeholder="Masukkan Kode Program" required>
                    </div>
                    <div class="mb-3">
                        <label for="uraian_program" class="form-label">Uraian Program</label>
                        <input type="text" class="form-control" id="uraian_program" name="uraian_program" placeholder="Masukkan Uraian Program" required>
                    </div>
                    <div class="d-grid">
                        <button type="submit" class="btn btn-primary" name="simpan">Simpan</button>
                    </div>
                </form>
            </div>
            <div class="table-container">
                <h3>List Program</h3>
                <table class="table table-bordered" id="aktivitasTable">
    <thead>
        <tr>
            <th>No</th>
            <th>Kode Program</th>
            <th>Uraian Program</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php
        include "service/database.php";
        $no = 1;
        $query = "SELECT kode_program, uraian_program FROM tbl_program1 ORDER BY kode_program ASC";
        $result = $koneksi->query($query);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>".$no++."</td>";
                echo "<td>".$row['kode_program']."</td>";
                echo "<td>".$row['uraian_program']."</td>";
                echo "<td>
                        <a href='edit_program.php?id=".$row['id']."' class='btn btn-warning btn-sm'>Edit</a>
                        <a href='hapus_program.php?id=".$row['id']."' class='btn btn-danger btn-sm' onclick=\"return confirm('Yakin ingin menghapus data ini?');\">Hapus</a>
                      </td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='4' class='text-center'>Belum ada data</td></tr>";
        }
        ?>
    </tbody>
</table>

            </div>
        </div>
    </div>
    <script src="js/bootstrap.bundle.min.js"></script>
</body>
</html>
