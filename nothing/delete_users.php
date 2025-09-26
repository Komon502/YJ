<?php
session_start();
include 'db_connect.php';

// ตรวจสอบล็อกอิน
if (!isset($_SESSION['A_Username'])) {
    header("Location: login.php");
    exit();
}

// ตรวจสอบว่ามี id
if (!isset($_GET['id'])) {
    header("Location: manage_users.php");
    exit();
}

$id = intval($_GET['id']);
$result = mysqli_query($conn, "SELECT * FROM admin WHERE A_ID=$id");
$user = mysqli_fetch_assoc($result);

if (!$user) { echo "❌ ไม่พบผู้ใช้"; exit(); }

$error = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['confirm'])) {
        $sql = "DELETE FROM admin WHERE A_ID=$id";
        if (mysqli_query($conn, $sql)) {
            header("Location: manage_users.php?msg=deleted");
            exit();
        } else { $error = "❌ เกิดข้อผิดพลาด: ".mysqli_error($conn); }
    } else {
        header("Location: manage_users.php");
        exit();
    }
}
?>
<!DOCTYPE html>
<html lang="th">
<head>
<meta charset="UTF-8">
<title>ลบผู้ใช้</title>
<link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Prompt:wght@400;600;700&display=swap" rel="stylesheet">
<style>
body, input, textarea, select, button, label, h1,h2,h3,h4,h5,h6 { font-family:'Prompt',sans-serif !important;}
body { background: linear-gradient(135deg,#0f0f0f,#1c1c1c); color:#fff; margin:0; padding:0; display:flex; justify-content:center; align-items:center; min-height:100vh;}
.container { width:100%; max-width:450px; padding:20px;}
.form-card { background:#181818; padding:40px; border-radius:20px; box-shadow:0 8px 25px rgba(0,0,0,0.6); text-align:center;}
.form-card h2 { color:#f44336; margin-bottom:25px; font-weight:700; text-align:center;}
.btn-danger { background:linear-gradient(45deg,#f44336,#b71c1c); border:none; border-radius:30px; font-weight:600; padding:12px 30px; color:#fff; margin:10px;}
.btn-danger:hover { opacity:0.9; transform:translateY(-2px);}
.btn-secondary { background:#242424; border:1px solid #444; border-radius:30px; font-weight:500; padding:12px 30px; color:#fff; margin:10px;}
.btn-secondary:hover { background:#f44336; border-color:#f44336; color:#fff;}
.alert { border-radius:12px; margin-bottom:20px; font-size:0.95rem; text-align:center;}
</style>
</head>
<body>
<div class="container">
  <div class="form-card">
    <h2>⚠️ ยืนยันการลบผู้ใช้</h2>
    <p>คุณแน่ใจหรือไม่ว่าต้องการลบผู้ใช้ <strong><?= htmlspecialchars($user['A_Username']) ?></strong> ?</p>
    <?php if(!empty($error)) echo "<div class='alert alert-danger'>$error</div>"; ?>
    <form method="post">
      <button type="submit" name="confirm" class="btn-danger">ยืนยันลบ</button>
      <button type="submit" name="cancel" class="btn-secondary">ยกเลิก</button>
    </form>
  </div>
</div>
</body>
</html>
