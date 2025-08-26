<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>หน้าหลัก</title>

    <!-- Bootstrap CDN -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css">

    <style>
        body {
            background-color: #f4f6fa;
            font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
        }
        .navbar {
            background-color: #0d47a1; 
        }
        .navbar-brand, .nav-link, .navbar-text {
            color: #fff !important;
        }
        .container {
            margin-top: 50px;
        }
        .card {
            border-radius: 15px;
            box-shadow: 0px 4px 12px rgba(0,0,0,0.1);
        }
        .card-header {
            background-color: #c01565ff; 
            color: #fff;
            font-weight: 600;
            font-size: 18px;
            border-top-left-radius: 15px;
            border-top-right-radius: 15px;
        }
        .btn-logout {
            background-color: #12d0d7ff;
            color: #fff;
            border-radius: 8px;
            padding: 8px 20px;
            text-decoration: none;
            transition: 0.3s;
        }
        .btn-logout:hover {
            background-color: #82be1cff;
            color: #fff;
        }
    </style>
</head>
<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg">
      <div class="container-fluid">
        <div class="d-flex">
            <span class="navbar-text me-3">
                <?= htmlspecialchars($_SESSION['username']) ?> (<?= $_SESSION['role'] ?>)
            </span>
            <a href="logout.php" class="btn-logout">ออกจากระบบ</a>
        </div>
      </div>
    </nav>

    <!-- Main Content -->
    <div class="container">
        <div class="card mt-4">
            <div class="card-header">
                หน้าหลัก
            </div>
            <div class="card-body text-center">
                <h3 class="mb-3">ยินดีต้อนรับสู่หน้าหลัก</h3>
                <p class="lead">ผู้ใช้: <b><?= htmlspecialchars($_SESSION['username']) ?></b> (<?= $_SESSION['role'] ?>)</p>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
