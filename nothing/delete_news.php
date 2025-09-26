<?php
session_start();
include 'db_connect.php';

if (!isset($_SESSION['A_Username'])) { header("Location: login.php"); exit(); }
if (!isset($_GET['id'])) { header("Location: manage_news.php"); exit(); }

$id = intval($_GET['id']);
$result = mysqli_query($conn, "SELECT * FROM news WHERE NewsID=$id");
$news = mysqli_fetch_assoc($result);

if (!$news) { echo "❌ ไม่พบข่าวสาร"; exit(); }

$error = "";
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['confirm'])) {
        $sql = "DELETE FROM news WHERE NewsID=$id";
        if (mysqli_query($conn, $sql)) {
            header("Location: manage_news.php?msg=deleted");
            exit();
        } else { $error = "❌ Error: ".mysqli_error($conn); }
    } else { header("Location: manage_news.php"); exit(); }
}
?>
<!DOCTYPE html>
<html lang="th">
<head>
<meta charset="UTF-8">
<title>ลบข่าวสาร</title>
<link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Prompt:wght@400;600;700&display=swap" rel="stylesheet">
<style>
body, input, textarea, select, button, label, h1,h2,h3,h4,h5,h6 { font-family:'Prompt',sans-serif !important;}
body { background: linear-gradient(135deg,#0f0f0f,#1c1c1c); color:#fff; margin:0; padding:0;}
.form-card { background:#181818; padding:40px; border-radius:20px; box-shadow:0 8px 25px rgba(0,0,0,0.6); max-width:600px; margin:80px auto; text-align:center;}
.form-card h2 { color:#f44336; margin-bottom:25px; font-weight:700; }
.btn-danger { background:linear-gradient(45deg,#f44336,#b71c1c); border:none; border-radius:30px; font-weight:600; padding:12px 30px;}
.btn-secondary { border-radius:30px; padding:12px 30px; font-weight:500;}
.alert { border-radius:12px; margin-bottom:20px; font-size:0.95rem;}
</style>
</head>
<body>
<div class="form-card">
<h2>⚠️ ยืนยันการลบข่าวสาร</h2>
<p>คุณแน่ใจหรือไม่ว่าต้องการลบข่าวสาร <strong><?= htmlspecialchars($news['N_Title']) ?></strong> ?</p>
<?php if(!empty($error)) echo "<div class='alert alert-danger'>$error</div>"; ?>
<form method="post">
    <button type="submit" name="confirm" class="btn btn-danger">ยืนยันลบ</button>
    <button type="submit" name="cancel" class="btn btn-secondary">ยกเลิก</button>
</form>
</div>
</body>
</html>
