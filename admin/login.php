<?php
include 'db_connect.php';
session_start();

// ถ้าเคยล็อกอินแล้ว → กระโดดไป dashboard เลย
if (isset($_SESSION['A_ID'])) {
    header("Location: admin_dashboard.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = $_POST['password'];

    // ตรวจสอบ username
    $sql = "SELECT * FROM admin WHERE A_Username=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $row = $result->fetch_assoc();

        // ตรวจสอบรหัสผ่าน (ต้องตรงกับ hash ที่เก็บใน DB)
        if (password_verify($password, $row['A_Password'])) {
            // ✅ เก็บค่า session
            $_SESSION['A_ID'] = $row['A_ID'];
            $_SESSION['A_Username'] = $row['A_Username'];
            $_SESSION['A_Name'] = $row['A_Name'];

            header("Location: admin_dashboard.php");
            exit();
        } else {
            $error = "❌ รหัสผ่านไม่ถูกต้อง";
        }
    } else {
        $error = "❌ ไม่พบ username นี้";
    }
}
?>
<!DOCTYPE html>
<html lang="th">
<head>
<meta charset="utf-8">
<title>Login - YJ Creating</title>
<link href="https://fonts.googleapis.com/css2?family=Prompt:wght@200;400;600&display=swap" rel="stylesheet">
<link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
<style>
    * { font-family: 'Prompt', sans-serif; }
    body { background:#000; color:#fff; margin:0; }
    .login-container { display:flex; flex-direction:column; align-items:center; justify-content:center; min-height:100vh; padding:20px; text-align:center; }
    .logo img { height:80px; margin-bottom:20px; }
    .card { background:#111; border:none; border-radius:15px; box-shadow:0 4px 15px rgba(255,255,255,0.1); width:100%; max-width:400px; padding:30px 25px; text-align:center; }
    .card h2 { color:#ff5733; margin-bottom:10px; font-size:1.6rem; }
    .card h4 { font-weight:300; color:#bbb; margin-bottom:20px; font-size:1rem; }
    .form-control { background:#222; border:1px solid #333; color:#fff; text-align:center; margin-bottom:15px; }
    .form-control:focus { border-color:#ff5733; box-shadow:none; }
    .btn-login { background:#ff5733; border:none; border-radius:25px; padding:10px; font-weight:bold; color:#fff; transition:0.3s; font-size:1rem; width:100%; }
    .btn-login:hover { background:#c70039; }
    .register-link { display:block; margin-top:15px; color:#bbb; text-decoration:none; font-size:0.9rem; }
    .register-link:hover { color:#ff5733; }
    .alert { margin-bottom:15px; }
</style>
</head>
<body>
<div class="login-container">
    <div class="logo"><img src="image/YJ.png" alt="YJ Logo"></div>
    <div class="card">
        <h2>เข้าสู่ระบบ</h2>
        <h4>YJ Creating Admin</h4>

        <?php if (!empty($error)) { ?>
            <div class="alert alert-danger" role="alert"><?= $error; ?></div>
        <?php } ?>

        <form action="" method="post">
            <input type="text" class="form-control" name="username" placeholder="Username" required>
            <input type="password" class="form-control" name="password" placeholder="Password" required>
            <button type="submit" class="btn-login">เข้าสู่ระบบ</button>
        </form>

        <a href="register.php" class="register-link">สมัครสมาชิก</a>
    </div>
</div>
<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>
