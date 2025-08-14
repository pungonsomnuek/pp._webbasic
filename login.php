<?php

    session_start(); //ไว้เกบตัวเเปรsection
    require_once 'config.php';

    $error = '';

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    //รับค่าจากฟอร์ม
    $usernameOremail = trim($_POST['username_or_email']);
    $password = $_POST['password'];
    
                //เอาค่าที่ตรวจสอบจากฟอม ไปตรวจสอบข้อมุลตรงกันใน db หรือไม่
        $sql = "SELECT * FORM users WHERE (username = ? OR email = ?)";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$usernameOremail,  $password,]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if($user && password_verify($password, $user['password'])){

            $_SESSION['user_id'] = $user['user_id'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['role'] = $user['role'];

            if($user['role'] === 'admin'){
                header("Location: admin/index.php");
                }else{
                    header("Location: index.php");
                }
                exit(); // หยุดการทำงานของสคริป
            }else{
                $error = "ชื่อผู้ใช้ไม่ถูกต้อง";
            }

        }

?>




<!DOCTYPE html>
<html lang="th">
<head>
<meta charset="UTF-8">
<title>เขำ้สรู่ระบบ</title>

    <!-- Boostrap CDN -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css">

    <!-- Boostrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>

</head>
<body class="container mt-5">

<?php if (isset($_GET['register']) && $_GET['register'] === 'success'): ?>
<div class="alert alert-success">สมัครสมำชิกสำเร็จ กรุณาเข้าสู่ระบบ</div>
<?php endif; ?>
>
<?php if (!empty($error)): ?>
<div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
<?php endif; ?>



<h2>เข้าสู่ระบบ</h2>
<div>
    <form method="post" class="row g-3">
    <div class="col-md-6">
    <label for="username_or_email" class="form-label">ชื่อผู้ใช้หรอีเมล</label>
    <input type="text" name="username_or_email" id="username_or_email" class="form-control" required>
    </div>
    <div class="col-md-6">
    <label for="password" class="form-label">รหัสผ่าน</label>
    <input type="password" name="password" id="password" class="form-control" required>
    </div>
    <div class="col-12">
    <button type="submit" class="btn btn-success">เข้าสู่ระบบ</button>
    <a href="register.php" class="btn btn-link">สมัครสมาชิก</a>
    </div>
    </form>
    </body>
    </html>
</div>