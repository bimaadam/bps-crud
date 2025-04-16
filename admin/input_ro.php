<?php 
include "service/database.php";
include "header.php";

$message = "";
if(isset($_POST["simpan"])){
    $kode_program = trim($_POST["kode_program"]);
    $kode_kegiatan = trim($_POST["kode_kegiatan"]);
    $kode_kro = trim($_POST["kode_kro"]);
    $kode_ro = trim($_POST["kode_ro"]);
    $uraian_ro = trim($_POST["uraian_ro"]);

    if(empty($kode_program) || empty($kode_kegiatan) || empty($kode_kro) || empty($kode_ro) || empty($uraian_ro)) {
        $message = '<div class="alert alert-danger">Semua kolom harus diisi!</div>';
    } else {
        $sql = "INSERT INTO tbl_ro1 (kode_program, kode_kegiatan, kode_kro, kode_ro, uraian_ro) VALUES (?, ?, ?, ?, ?)";
        $stmt = $koneksi->prepare($sql);
        $stmt->bind_param("sssss", $kode_program, $kode_kegiatan, $kode_kro, $kode_ro, $uraian_ro);
        
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
    <title>Tambah RO</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <style>
        .container-wrapper {
            display: flex;
        }
        .content {
            flex: 1;
            padding: 20px;
        }
    </style>
</head>
<body>
<div class="container-wrapper">
    <?php include "sidebar.php"; ?>
    <div class="content">
        <h2 class="text-center mb-4">Tambah RO</h2>
        <?php if(isset($message)) echo $message; ?>
        <div class="card p-4">
            <form action="input_ro.php" method="POST">
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
                    <label for="kode_ro" class="form-label">Kode RO</label>
                    <input type="text" class="form-control" id="kode_ro" name="kode_ro" required>
                </div>
                <div class="mb-3">
                    <label for="uraian_ro" class="form-label">Uraian RO</label>
                    <input type="text" class="form-control" id="uraian_ro" name="uraian_ro" required>
                </div>
                <div class="d-grid">
                    <button type="submit" class="btn btn-primary" name="simpan">Simpan</button>
                </div>
            </form>
        </div>
        <div class="table-container mt-4">
    <h3>List RO</h3>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>No</th>
                <th>Kode Program</th>
                <th>Kode Kegiatan</th>
                <th>Kode KRO</th>
                <th>Kode RO</th>
                <th>Uraian RO</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php
include "service/database.php";

$limit = 25; // Jumlah data per halaman
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$start = ($page - 1) * $limit;

// Ambil total data
$totalQuery = "SELECT COUNT(*) as total FROM tbl_ro1";
$totalResult = $koneksi->query($totalQuery);
$totalData = $totalResult->fetch_assoc()['total'];
$totalPages = ceil($totalData / $limit);

// Ambil data untuk halaman saat ini
$query = "SELECT * FROM tbl_ro1 ORDER BY kode_program ASC LIMIT $start, $limit";
$result = $koneksi->query($query);
$no = $start + 1;

            if ($result && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>".$no++."</td>";
            echo "<td>".$row['kode_program']."</td>";
            echo "<td>".$row['kode_kegiatan']."</td>";
            echo "<td>".$row['kode_kro']."</td>";
            echo "<td>".$row['kode_ro']."</td>";
            echo "<td>".$row['uraian_ro']."</td>";
            echo "<td>
                    <a href='edit_ro.php?kode_ro=".$row['kode_ro']."' class='btn btn-warning btn-sm'>Edit</a>
                    <a href='hapus_ro.php?kode_ro=".$row['kode_ro']."' class='btn btn-danger btn-sm' onclick=\"return confirm('Yakin ingin menghapus data ini?');\">Hapus</a>
                  </td>";
            echo "</tr>";
        }
    } else {
        echo "<tr><td colspan='7' class='text-center'>Belum ada data</td></tr>";
    }
    ?>
        </tbody>
    </table>
    <nav>
    <ul class="pagination justify-content-center">
        <?php if($page > 1): ?>
            <li class="page-item">
                <a class="page-link" href="?page=<?php echo $page - 1; ?>">Sebelumnya</a>
            </li>
        <?php endif; ?>

        <?php for($i = 1; $i <= $totalPages; $i++): ?>
            <li class="page-item <?php echo ($i == $page) ? 'active' : ''; ?>">
                <a class="page-link" href="?page=<?php echo $i; ?>"><?php echo $i; ?></a>
            </li>
        <?php endfor; ?>

        <?php if($page < $totalPages): ?>
            <li class="page-item">
                <a class="page-link" href="?page=<?php echo $page + 1; ?>">Berikutnya</a>
            </li>
        <?php endif; ?>
    </ul>
</nav>

</div>

    </div>
</div>
<script src="js/bootstrap.bundle.min.js"></script>
</body>
</html>