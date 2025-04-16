<?php 
include "service/database.php";

if(isset($_POST["simpan"])){
    $kode_program = trim($_POST["kode_program"]);
    $kode_kegiatan = trim($_POST["kode_kegiatan"]);
    $kode_kro = trim($_POST["kode_kro"]);
    $uraian_kro = trim($_POST["uraian_kro"]);
    $kro_2 = trim($_POST["kro_2"]);

    // Validasi biar nggak ada data kosong
    if(empty($kode_program) || empty($kode_kegiatan) || empty($kode_kro) || empty($uraian_kro) || empty($kro_2)) {
        $message = '<div class="alert alert-danger">Semua kolom harus diisi!</div>';
    } else {
        // Gunakan Prepared Statements
        $sql = "INSERT INTO tbl_kro1 (kode_program, kode_kegiatan, kode_kro, uraian_kro, kro_2) VALUES (?, ?, ?, ?, ?)";
        $stmt = $koneksi->prepare($sql);
        $stmt->bind_param("sssss", $kode_program, $kode_kegiatan, $kode_kro, $uraian_kro, $kro_2);

        if($stmt->execute()) {
            $message = '<div class="alert alert-success">Data berhasil disimpan!</div>';
        } else {
            $message = '<div class="alert alert-danger">Data gagal disimpan!</div>';
        }

        $stmt->close();
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah KRO</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
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
<body>

<?php include "header.php"; ?>

<div class="container-wrapper">
    <?php include "sidebar.php"; ?>

    <div class="content">
        <div class="container mt-4">
            <h2 class="text-center mb-4">Tambah KRO</h2>

            <?php if(isset($message)) echo $message; ?> <!-- Tampilkan alert -->

            <div class="card p-4">
                <form action="input_kro.php" method="POST">
                    <div class="mb-3">
                        <label for="kode_program" class="form-label">Kode Program</label>
                        <input type="text" class="form-control" id="kode_program" name="kode_program" required>
                    </div>
                    <div class="mb-3">
                        <label for="kode_kegiatan" class="form-label">Kode Kegiatan</label>
                        <input type="text" class="form-control" id="kode_kegiatan" name="kode_kegiatan" required>
                    </div>
                    <div class="mb-3">
                        <label for="kode_kro" class="form-label">Kode KRO</label>
                        <input type="text" class="form-control" id="kode_kro" name="kode_kro" required>
                    </div>
                    <div class="mb-3">
                        <label for="uraian_kro" class="form-label">Uraian KRO</label>
                        <input type="text" class="form-control" id="uraian_kro" name="uraian_kro" required>
                    </div>
                    <div class="mb-3">
                        <label for="kro_2" class="form-label">KRO 2</label>
                        <input type="text" class="form-control" id="kro_2" name="kro_2" required>
                    </div>
                    <div class="d-grid">
                        <button type="submit" class="btn btn-primary" name="simpan">Simpan</button>
                    </div>
                </form>
            </div>
            <div class="table-container">
               <div class="table-container mt-4">
    <h3>List KRO</h3>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>No</th>
                <th>Kode Program</th>
                <th>Kode Kegiatan</th>
                <th>Kode KRO</th>
                <th>Uraian KRO</th>
                <th>KRO 2</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php
            include "service/database.php";
            $no = 1;
            $query = "SELECT * FROM tbl_kro1 ORDER BY kode_program ASC";
            $result = $koneksi->query($query);

            if ($result && $result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>".$no++."</td>";
                    echo "<td>".$row['kode_program']."</td>";
                    echo "<td>".$row['kode_kegiatan']."</td>";
                    echo "<td>".$row['kode_kro']."</td>";
                    echo "<td>".$row['uraian_kro']."</td>";
                    echo "<td>".$row['kro_2']."</td>";
                    echo "<td>
                            <a href='edit_kro.php?kode_kro=".$row['kode_kro']."' class='btn btn-warning btn-sm'>Edit</a>
                            <a href='hapus_kro.php?kode_kro=".$row['kode_kro']."' class='btn btn-danger btn-sm' onclick=\"return confirm('Yakin ingin menghapus data ini?');\">Hapus</a>
                          </td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='7' class='text-center'>Belum ada data</td></tr>";
            }
            ?>
        </tbody>
    </table>
</div>

            </div>
        </div>
    </div>
</div>

<script src="js/bootstrap.bundle.min.js"></script>
</body>
</html>
