<?php
    require_once 'config.php';

    if($_SERVER['REQUEST_METHOD'] === 'POST'){
        //รับค่าจากฟอร์ม
        $username = trim($_POST['username']);
        $fullname = trim($_POST['fullname']);
        $email = trim($_POST['email']);
        $password = $_POST['password'];
        $confirmpassword = $_POST['confirmpassword'];
        
        // นำข้อมูลไปบันทึกในฐานข้อมูล
        
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        
        $sql = "INSERT INTO users(username, full_name, email, password,role) VALUES (?, ?, ?, ?, 'admin')";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$username, $fullname, $email, $hashedPassword]);
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>

    <!-- Boostrap CDN -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css">
    <style>
          body {
            background: linear-gradient(to right, #ff003cff, #ff00b7ff);
            font-family: 'Segoe UI', sans-serif;
        }

        .container {
            max-width: 500px;
            background: white;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 5px 25px rgba(0,0,0,0.1);
        }

        h2 {
            text-align: center;
            margin-bottom: 25px;
            font-weight: bold;
            color: #0077b6;
        }

        .form-label {
            font-weight: 500;
        }

        .form-control {
            border-radius: 10px;
            border: 1px solid #ccc;
            transition: all 0.3s;
        }

        .form-control:focus {
            border-color: #0077b6;
            box-shadow: 0 0 8px rgba(0, 119, 182, 0.3);
        }

        .btn-primary {
            width: 100%;
            border-radius: 10px;
            background: #0077b6;
            border: none;
        }

        .btn-primary:hover {
            background: #023e8a;
        }

        .btn-link {
            display: block;
            text-align: center;
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
    <h2>สมัครสมาชิก</h2>
    <form method="post">
        <div>
            <label for="username" class="form-label">ชื่อผู้ใช้</label>
            <input type="text" name="username" id="username" class="form-control" placeholder="กรุณากรอกชื่อผู้ใช้" required>
        </div>
        <div>
            <label for="fullname" class="form-label">ชื่อ-สกุล</label>
            <input type="text" name="fullname" id="fullname" class="form-control" placeholder="กรุณากรอกชื่อ-สกุล" required>
        </div>
        <div>
            <label for="email" class="form-label">อีเมล</label>
            <input type="email" name="email" id="email" class="form-control" placeholder="กรุณากรอกอีเมล" required>
        </div>
        <div>
            <label for="password" class="form-label">รหัสผ่าน</label>
            <input type="password" name="password" id="password" class="form-control" placeholder="กรุณากรอกรหัสผ่าน" required>
        </div>
        <div>
            <label for="confirmpassword" class="form-label">ยืนยันรหัสผ่าน</label>
            <input type="password" name="confirmpassword" id="confirmpassword" class="form-control" placeholder="กรุณายืนยันรหัสผ่าน" required>
        </div>
        <div class="mt-3">
            <button type="submit" class="btn btn-primary">สมัครสมาชิก</button>
            <a href = "login.php" class="btn btn-link">เข้าสู่ระบบ</a>
        </div>
    </form>
    </div>
    
    <!-- Boostrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>