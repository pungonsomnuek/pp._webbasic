<?php
session_start(); 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>หน้าหลัก</title>
</head>
<body>
    <h1>ยินดีต้อนรับสู่หน้าหลัก</h1>
    <p>ผู้ใช้: <?= htmlspecialchars($_SESSION['username']) ?>(<?=$_SESSION['role']?>) </p>

    <div>
        <a href="logout" class="btn btn-secondary">ออกจากระบบ</a>
    </div>
    <!-- Boostrap CDN -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css">
    <style></style>
</body>
</html>