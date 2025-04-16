<?php 
include "service/database.php";

if(isset($_POST["simpan"])){
    $kode_program = $_POST["kode_program"];
    $kode_kegiatan = $_POST["kode_kegiatan"];
    $uraian_kegiatan = $_POST["uraian_kegiatan"];

    $sql = "INSERT INTO tbl_kegiatan1 (kode_program, kode_kegiatan, uraian_kegiatan) VALUES ('$kode_program', '$kode_kegiatan', '$uraian_kegiatan')";

    if($koneksi->query($sql)) {
        echo "<script>alert('Data berhasil disimpan!'); window.location.href='input_kegiatan.php';</script>";
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
    <title>Tambah Kegiatan</title>
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
                <h2>Tambah Kegiatan</h2>
                <form action="input_kegiatan.php" method="POST">
                    <div class="mb-3">
                        <label for="kode_program" class="form-label">Kode Program</label>
                        <input type="text" class="form-control" id="kode_program" name="kode_program" placeholder="Masukkan Kode Program" required>
                    </div>
                    <div class="mb-3">
                        <label for="kode_kegiatan" class="form-label">Kode Kegiatan</label>
                        <input type="text" class="form-control" id="kode_kegiatan" name="kode_kegiatan" placeholder="Masukkan Kode Kegiatan" required>
                    </div>
                    <div class="mb-3">
                        <label for="uraian_kegiatan" class="form-label">Uraian Kegiatan</label>
                        <input type="text" class="form-control" id="uraian_kegiatan" name="uraian_kegiatan" placeholder="Masukkan Uraian Kegiatan" required>
                    </div>
                    <div class="d-grid">
                        <button type="submit" class="btn btn-primary" name="simpan">Simpan</button>
                    </div>
                </form>
            </div>
            <div class="table-container">
                <<div class="table-container">
    <h3>List Kegiatan</h3>
    <table class="table table-bordered" id="aktivitasTable">
        <thead>
            <tr>
                <th>No</th>
                <th>Kode Program</th>
                <th>Kode Kegiatan</th>
                <th>Uraian Kegiatan</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php
            include "service/database.php";
            $no = 1;
            $query = "SELECT kode_program, kode_kegiatan, uraian_kegiatan FROM tbl_kegiatan1 ORDER BY kode_program ASC";
            $result = $koneksi->query($query);

            if ($result && $result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>".$no++."</td>";
                    echo "<td>".$row['kode_program']."</td>";
                    echo "<td>".$row['kode_kegiatan']."</td>";
                    echo "<td>".$row['uraian_kegiatan']."</td>";
                    echo "<td>
                            <a href='edit_kegiatan.php?kode_kegiatan=".$row['kode_kegiatan']."' class='btn btn-warning btn-sm'>Edit</a>
                            <a href='hapus_kegiatan.php?kode_kegiatan=".$row['kode_kegiatan']."' class='btn btn-danger btn-sm' onclick=\"return confirm('Yakin ingin menghapus data ini?');\">Hapus</a>
                          </td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='5' class='text-center'>Belum ada data</td></tr>";
            }
            ?>
        </tbody>
    </table>
</div>


            </div>
        </div>
    </div>

    <script src="js/bootstrap.bundle.min.js"></script>
</body>
</html>
