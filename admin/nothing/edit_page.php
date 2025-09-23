<?php
session_start();
if (!isset($_SESSION['A_Username'])) {
    header("Location: login.php");
    exit();
}
include 'db_connect.php';

$id = intval($_GET['id']);
$sql = "SELECT * FROM pages WHERE Page_ID=$id";
$page = $conn->query($sql)->fetch_assoc();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $conn->real_escape_string($_POST['title']);
    $content = $conn->real_escape_string($_POST['content']);
    $admin_id = 1; // คุณสามารถเปลี่ยนเป็น $_SESSION['A_ID'] ถ้ามีเก็บไว้

    $update_sql = "UPDATE pages SET P_Title='$title', P_Content='$content', AdminID=$admin_id WHERE Page_ID=$id";
    $conn->query($update_sql);

    header("Location: manage_pages.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <title>แก้ไขหน้าเว็บ - YJ Creating</title>
    <link href="https://fonts.googleapis.com/css2?family=Prompt:wght@200;400;600&display=swap" rel="stylesheet">
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <style>
        * { font-family: 'Prompt', sans-serif; }
        body { background:#000; color:#fff; margin:0; }
        .container { max-width:800px; margin:50px auto; }
        h2 { color:#ff5733; margin-bottom:20px; text-align:center; }
        label { margin-top:10px; }
        textarea { min-height:200px; }
        .btn-save { background:#ff5733; color:#fff; padding:10px 20px; border:none; border-radius:8px; }
        .btn-save:hover { background:#c70039; }
    </style>
</head>
<body>
<div class="container">
    <h2>✏️ แก้ไขหน้า: <?= ucfirst($page['Page_Name']) ?></h2>
    <form method="post">
        <div class="mb-3">
            <label class="form-label">หัวข้อ (Title):</label>
            <input type="text" name="title" class="form-control" value="<?= htmlspecialchars($page['P_Title']) ?>">
        </div>
    <div class="form-group row">
<label class="col-lg-2 col-form-label">รูปภาพ</label>
<div class="col-lg-9">
<input class="form-control" name="aimage" type="file" required="">
</div> 
        <div class="mb-3">
            <label class="form-label">เนื้อหา (Content):</label>
            <textarea name="content" class="form-control"><?= htmlspecialchars($page['P_Content']) ?></textarea>
        </div>
        <button type="submit" class="btn-save">💾 บันทึก</button>
        <a href="manage_pages.php" class="btn btn-secondary">⬅️ กลับ</a>
    </form>
</div>
<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>
