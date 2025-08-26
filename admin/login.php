<?php
session_start(); // ไว้เก็บตัวแปร session
require_once 'config.php';

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // รับค่าจากฟอร์ม
    $usernameOremail = trim($_POST['username_or_email']);
    $password = $_POST['password'];

    // ตรวจสอบข้อมูลจาก DB
    $sql = "SELECT * FROM users WHERE (username = ? OR email = ?)";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$usernameOremail, $usernameOremail]); // ต้องใส่ 2 ตัว (username, email)
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user_id']  = $user['user_id'];
        $_SESSION['username'] = $user['username'];
        $_SESSION['role']     = $user['role'];

        if ($user['role'] === 'admin') {
            header("Location: admin/index.php");
        } else {
            header("Location: index.php");
        }
        exit(); // หยุดการทำงาน
    } else {
        $error = "ชื่อผู้ใช้หรือรหัสผ่านไม่ถูกต้อง";
    }
}
?>
<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <title>เข้าสู่ระบบ</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css">

    <style>
        body {
            background: #0d6efd; /* พื้นหลังฟ้า */
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh; /* จัดให้อยู่กลางจอ */
        }
        .login-card {
            width: 100%;
            max-width: 420px;
        }
    </style>
</head>
<body>

<div class="card login-card shadow-lg rounded-4">
    <div class="card-body p-4">
        <?php if (isset($_GET['register']) && $_GET['register'] === 'success'): ?>
            <div class="alert alert-success">สมัครสมาชิกสำเร็จ กรุณาเข้าสู่ระบบ</div>
        <?php endif; ?>

        <?php if (!empty($error)): ?>
            <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
        <?php endif; ?>

        <h3 class="card-title text-center mb-4">เข้าสู่ระบบ</h3>
        <form method="post">
            <div class="mb-3">
                <label for="username_or_email" class="form-label">ชื่อผู้ใช้หรืออีเมล</label>
                <input type="text" name="username_or_email" id="username_or_email" 
                       class="form-control" placeholder="กรอกชื่อผู้ใช้หรืออีเมล" required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">รหัสผ่าน</label>
                <input type="password" name="password" id="password" 
                       class="form-control" placeholder="กรอกรหัสผ่าน" required>
            </div>
            <button type="submit" class="btn btn-primary w-100">เข้าสู่ระบบ</button>
            <a href="register.php" class="btn btn-link d-block text-center mt-2">สมัครสมาชิก</a>
        </form>
    </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
