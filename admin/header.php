<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <link href="../css/styles.css" rel="stylesheet">
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
    <style>
        .logo {
            height: 50px;
            width: 50px;
            padding-right: 10px;
        }
        .navbar-custom {
            background-color:rgb(18, 75, 161);
        }
        .navbar-custom .navbar-brand {
            font-weight: bold;
            color: white;
        }
        .navbar-custom .user-info {
            color: white;
            font-size: 16px;
        }
    </style>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-custom">
    <div class="container-fluid">
        <img src="img/logo.svg" class="logo" alt="">
        <a class="navbar-brand" href="../index.php">BPS Kabupaten Tasikmalaya</a>
        <div class="ms-auto user-info">
            <i class="fas fa-user-circle"></i> Admin | 
            <button class="btn btn-primary">
                <a href="logout.php" class="text-white">Logout</a>
            </button>
        </div>
    </div>
</nav>
