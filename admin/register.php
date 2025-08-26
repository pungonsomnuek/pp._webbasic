<?php
require_once 'config.php';

$errors = []; // array to hold error messages

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // รับค่าจากฟอร์ม
    $username = trim($_POST['username']);
    $fullname = trim($_POST['fullname']);
    $email = trim($_POST['email']);
    $password = $_POST['password'];
    $confirmpassword = $_POST['confirmpassword'];

    // ตรวจสอบข้อมูล
    if (empty($username) || empty($fullname) || empty($email) || empty($password) || empty($confirmpassword)) {
        $errors[] = "กรุณากรอกข้อมูลให้ครบถ้วน";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "กรุณากรอกอีเมลให้ถูกต้อง";
    } elseif ($password !== $confirmpassword) {
        $errors[] = "รหัสผ่านและยืนยันรหัสผ่านไม่ตรงกัน";
    } else {
        // ตรวจสอบว่ามี username หรือ email ซ้ำหรือไม่
        $sql = "SELECT * FROM users WHERE username = ? OR email = ?";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$username, $email]);

        if ($stmt->rowCount() > 0) {
            $errors[] = "ชื่อผู้ใช้หรืออีเมลนี้ถูกใช้ไปแล้ว";
        }
    }

    if (empty($errors)) {
        // บันทึกข้อมูล
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $sql = "INSERT INTO users(username, full_name, email, password, role) VALUES (?, ?, ?, ?, 'member')";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$username, $fullname, $email, $hashedPassword]);

        // redirect ไปหน้า login
        header("Location: login.php?register=success");
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>สมัครสมาชิก</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css">

    <style>
        body {
            background: linear-gradient(to right, #ff80ab, #ff4081); /* พื้นหลังชมพู Gradient */
            font-family: 'Segoe UI', sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .register-card {
            max-width: 480px;
            width: 100%;
            padding: 25px;
            border-radius: 15px;
            background: #fff;
            box-shadow: 0px 5px 15px rgba(0,0,0,0.2);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        .register-card:hover {
            transform: translateY(-8px);
            box-shadow: 0px 10px 25px rgba(0,0,0,0.3);
        }
        .register-card h2 {
            text-align: center;
            margin-bottom: 20px;
            font-weight: bold;
            color: #e91e63;
        }
        .toggle-password {
            cursor: pointer;
            position: absolute;
            right: 15px;
            top: 38px;
            color: #888;
        }
    </style>
</head>
<body>

<div class="register-card">
    <h2>สมัครสมาชิก</h2>

    <?php if (!empty($errors)): ?>
        <div class="alert alert-danger">
            <ul class="mb-0">
                <?php foreach ($errors as $e): ?>
                    <li><?= htmlspecialchars($e) ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>

    <form method="post">
        <div class="mb-3">
            <label for="username" class="form-label">ชื่อผู้ใช้</label>
            <input type="text" name="username" id="username" 
                   class="form-control" placeholder="กรุณากรอกชื่อผู้ใช้"
                   value="<?= isset($_POST['username']) ? htmlspecialchars($_POST['username']) : '' ?>" required>
        </div>
        <div class="mb-3">
            <label for="fullname" class="form-label">ชื่อ-สกุล</label>
            <input type="text" name="fullname" id="fullname" 
                   class="form-control" placeholder="กรุณากรอกชื่อ-สกุล"
                   value="<?= isset($_POST['fullname']) ? htmlspecialchars($_POST['fullname']) : '' ?>" required>
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">อีเมล</label>
            <input type="email" name="email" id="email" 
                   class="form-control" placeholder="กรุณากรอกอีเมล"
