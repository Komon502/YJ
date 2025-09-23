<?php
session_start();
include 'db_connect.php';

if (!isset($_SESSION['A_Username'])) {
    header("Location: login.php");
    exit();
}

if (!isset($_GET['id'])) {
    header("Location: manage_event.php");
    exit();
}

$id = intval($_GET['id']);
$result = mysqli_query($conn, "SELECT * FROM event WHERE EventID=$id");
$event = mysqli_fetch_assoc($result);

if (!$event) { 
    echo "❌ ไม่พบอีเว้นท์"; 
    exit(); 
}

$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['confirm'])) {
        $sql = "DELETE FROM event WHERE EventID=$id";
        if (mysqli_query($conn, $sql)) {
            header("Location: manage_event.php?msg=deleted");
            exit();
        } else {
            $error = "❌ เกิดข้อผิดพลาด: " . mysqli_error($conn);
        }
    } else {
        header("Location: manage_event.php");
        exit();
    }
}
?>
<!DOCTYPE html>
<html lang="th">
<head>
<meta charset="UTF-8">
<title>ลบอีเว้นท์</title>
<link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Prompt:wght@400;600;700&display=swap" rel="stylesheet">
<style>
body, input, textarea, select, button, label, h1, h2, h3, h4, h5, h6 { font-family: 'Prompt', sans-serif !important; }
body { background: linear-gradient(135deg,#0f0f0f,#1c1c1c); color:#fff; margin:0; padding:0;}
.form-card { background:#181818; padding:40px; border-radius:20px; box-shadow:0 8px 25px rgba(0,0,0,0.6); max-width:600px; margin:80px auto; text-align:center; }
.form-card h2 { color:#f44336; margin-bottom:25px; font-weight:700; }
.btn-danger { background: linear-gradient(45deg,#f44336,#b71c1c); border:none; border-radius:30px; font-weight:600; padding:12px 30px; margin-right:10px; }
.btn-secondary { border-radius:30px; padding:12px 30px; font-weight:500; color:#fff; border:1px solid #444; background:#242424; }
.btn-secondary:hover { background:#f44336; border-color:#f44336; color:#fff; }
.alert { border-radius:12px; margin-bottom:20px; font-size:0.95rem; }
</style>
</head>
<body>
<div class="form-card">
  <h2>⚠️ ยืนยันการลบอีเว้นท์</h2>
  <p>คุณแน่ใจหรือไม่ว่าต้องการลบอีเว้นท์ <strong><?= htmlspecialchars($event['E_Title']) ?></strong> ?</p>
  <?php if(!empty($error)) echo "<div class='alert alert-danger'>$error</div>"; ?>
  <form method="post">
    <button type="submit" name="confirm" class="btn btn-danger">ยืนยันลบ</button>
    <button type="submit" name="cancel" class="btn btn-secondary">ยกเลิก</button>
  </form>
</div>
</body>
</html>
