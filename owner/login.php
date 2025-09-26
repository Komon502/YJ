<?php
session_start();

$error = "";

// 🔐 Owner ใช้บัญชีเดียว (fix)
$fixed_username = "owner";
$fixed_password = "1111"; // 👉 เปลี่ยนรหัสตามต้องการ

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    if ($username === $fixed_username && $password === $fixed_password) {
        $_SESSION['is_owner'] = true;
        $_SESSION['O_Username'] = $username;
        header("Location: owner_dashboard.php");
        exit();
    } else {
        $error = "❌ ชื่อผู้ใช้หรือรหัสผ่านไม่ถูกต้อง";
    }
}
?>
<!DOCTYPE html>
<html lang="th">
<head>
  <meta charset="UTF-8">
  <title>Owner Login</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body { background:#000; color:#fff; font-family:'Prompt', sans-serif; display:flex; justify-content:center; align-items:center; height:100vh; }
    .login-box { background:#111; padding:40px; border-radius:15px; width:100%; max-width:400px; box-shadow:0 6px 20px rgba(255,87,51,0.3); }
    h2 { text-align:center; margin-bottom:25px; color:#ff7043; }
    .form-control { background:#222; border:1px solid #555; color:#fff; }
    .form-control:focus { border-color:#ff7043; box-shadow:0 0 8px rgba(255,112,67,.7); }
    .btn-login { background:linear-gradient(45deg,#ff7043,#c22c0a); border:none; width:100%; font-weight:600; }
    .btn-login:hover { background:linear-gradient(45deg,#ff5733,#a62808); }
  </style>
</head>
<body>
  <div class="login-box">
    <h2>🔑 Owner Login</h2>
    <?php if ($error) echo "<div class='alert alert-danger text-center'>$error</div>"; ?>
    <form method="post">
      <div class="mb-3">
        <label>ชื่อผู้ใช้</label>
        <input type="text" name="username" class="form-control" required>
      </div>
      <div class="mb-3">
        <label>รหัสผ่าน</label>
        <input type="password" name="password" class="form-control" required>
      </div>
      <button type="submit" class="btn btn-login">เข้าสู่ระบบ</button>
    </form>
  </div>
</body>
</html>
