<?php 
session_start();

if (isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit();
}

include "service/database.php";

if (isset($_POST['login'])) {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    $sql = "SELECT * FROM user WHERE username=? AND password=?";
    $stmt = $koneksi->prepare($sql);
    $stmt->bind_param("ss", $username, $password);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $data = $result->fetch_assoc();
        $_SESSION['user_id'] = $data['id'];
        $_SESSION['username'] = $data['username'];

        header("Location: index.php");
        exit();
    } else {
        $error = "Username atau password salah!";
    }
}
?>


<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <style>
        body {
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(135deg, #007bff, #6610f2);
            color: white;
        }
        .form-container {
            width: 380px;
            padding: 30px;
            background: rgba(255, 255, 255, 0.2);
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.2);
            border-radius: 10px;
            backdrop-filter: blur(10px);
            text-align: center;
        }
        .form-container h2 {
            margin-bottom: 20px;
        }
        .form-control {
            background: rgba(255, 255, 255, 0.5);
            border: none;
            padding: 10px;
        }
        .form-control::placeholder {
            color: rgba(255, 255, 255, 0.8);
        }
        .btn-primary {
            background: #28a745;
            border: none;
        }
        .btn-primary:hover {
            background: #218838;
        }
        a {
            color: white;
            text-decoration: none;
        }
        a:hover {
            text-decoration: underline;
        }
        .alert {
            background: rgba(255, 0, 0, 0.7);
            color: white;
            border: none;
        }
    </style>
</head>
<body>

<div class="form-container">
    <h2>Login</h2>
    
    <?php if (isset($error)) : ?>
        <div class="alert alert-danger"><?= $error; ?></div>
    <?php endif; ?>

    <form action="login.php" method="POST">
        <div class="mb-3">
            <input type="text" class="form-control" id="username" name="username" placeholder="Username" required>
        </div>
        <div class="mb-3">
            <input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
        </div>
        <div class="d-grid">
            <button type="submit" class="btn btn-primary" name="login">Login</button>
        </div>
    </form>
    
    <!-- <div class="mt-3">
        <a href="sigin.php">Belum punya akun? Daftar</a>
    </div> -->
</div>

<script src="../js/bootstrap.bundle.min.js"></script>
</body>
</html>
