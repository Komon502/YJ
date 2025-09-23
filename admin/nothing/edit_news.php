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
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = isset($_POST['title']) ? mysqli_real_escape_string($conn, $_POST['title']) : '';
    $detail = isset($_POST['detail']) ? mysqli_real_escape_string($conn, $_POST['detail']) : '';
    $date = isset($_POST['date']) ? mysqli_real_escape_string($conn, $_POST['date']) : '';

    if (!empty($title) && !empty($detail) && !empty($date)) {
        $sql = "UPDATE news SET N_Title='$title', N_Detail='$detail', N_Date='$date' WHERE NewsID=$id";
        if (mysqli_query($conn, $sql)) {
            header("Location: manage_news.php?success=updated");
            exit();
        } else { $error = "❌ เกิดข้อผิดพลาด: ".mysqli_error($conn); }
    } else { $error = "กรุณากรอกข้อมูลให้ครบถ้วน"; }
}
?>
<!DOCTYPE html>
<html lang="th">
<head>
<meta charset="UTF-8">
<title>แก้ไขข่าวสาร</title>
<link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Prompt:wght@400;600;700&display=swap" rel="stylesheet">
<style>
body, input, textarea, select, button, label, h1,h2,h3,h4,h5,h6 { font-family:'Prompt',sans-serif !important; }
body { background: linear-gradient(135deg,#0f0f0f,#1c1c1c); color:#fff; margin:0; padding:0;}
.form-card {
    background:#181818;
    padding:50px 40px;
    border-radius:20px;
    box-shadow:0 8px 30px rgba(0,0,0,0.6);
    max-width:600px;
    margin:80px auto;
}
.form-card h2 { color:#f44336; margin-bottom:30px; font-weight:700; text-align:center; }
.form-group { margin-bottom:25px; }
label { font-weight:600; display:block; margin-bottom:8px; color:#ccc;}
.form-control {
    background:#202020;
    border:1px solid #333;
    color:#fff;
    border-radius:12px;
    padding:14px 16px;
    width:100%;
}
.form-control:focus { border-color:#f44336; box-shadow:0 0 0 0.25rem rgba(244,67,54,.35); background:#1a1a1a; color:#fff;}
.btn-submit {
    background:linear-gradient(45deg,#f44336,#b71c1c);
    border:none;
    border-radius:35px;
    font-weight:700;
    padding:14px 0;
    color:#fff;
    width:100%;
    font-size:1.2rem;
    margin-top:10px;
}
.btn-submit:hover { transform:translateY(-2px); opacity:0.9;}
.btn-back {
    display:block;
    text-align:center;
    text-decoration:none;
    margin-top:20px;
    padding:12px;
    border-radius:30px;
    font-weight:600;
    background:#242424;
    border:1px solid #444;
    color:#fff;
}
.btn-back:hover { background:#f44336; border-color:#f44336; color:#fff;}
.alert { border-radius:12px; margin-bottom:20px; font-size:0.95rem;}
</style>
</head>
<body>
<div class="form-card">
  <h2>แก้ไขข่าวสาร</h2>
  <?php if(!empty($error)) echo "<div class='alert alert-danger'>$error</div>"; ?>
  <form method="post">
    <div class="form-group">
      <label>หัวข้อข่าว</label>
      <input type="text" name="title" class="form-control" value="<?= htmlspecialchars($news['N_Title']) ?>" required>
    </div>

    <div class="form-group">
      <label>รายละเอียด</label>
      <textarea name="detail" class="form-control" rows="5" required><?= htmlspecialchars($news['N_Detail']) ?></textarea>
    </div>

    <div class="form-group">
      <label>วันที่</label>
      <input type="date" name="date" class="form-control" value="<?= $news['N_Date'] ?>" required>
    </div>

    <button type="submit" class="btn-submit">บันทึกการแก้ไข</button>
  </form>
  <a href="manage_news.php" class="btn-back">กลับสู่แดชบอร์ด</a>
</div>
</body>
</html>
