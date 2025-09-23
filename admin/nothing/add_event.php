<?php
session_start();
include 'db_connect.php';

// ถ้ายังไม่ได้ล็อกอิน → กลับไป login
if (!isset($_SESSION['A_Username'])) {
    header("Location: login.php");
    exit();
}

$error = "";

// เช็คว่ามีการกด submit ฟอร์มหรือไม่
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = isset($_POST['title']) ? mysqli_real_escape_string($conn, $_POST['title']) : '';
    $detail = isset($_POST['detail']) ? mysqli_real_escape_string($conn, $_POST['detail']) : '';
    $date = isset($_POST['date']) ? mysqli_real_escape_string($conn, $_POST['date']) : '';
    $location = isset($_POST['location']) ? mysqli_real_escape_string($conn, $_POST['location']) : '';

    if (!empty($title) && !empty($detail) && !empty($date) && !empty($location)) {
        $sql = "INSERT INTO event (E_Title, E_Detail, E_Date, E_Location)
                VALUES ('$title', '$detail', '$date', '$location')";
        if (mysqli_query($conn, $sql)) {
            header("Location: manage_event.php?success=1");
            exit();
        } else {
            $error = "เกิดข้อผิดพลาด: " . mysqli_error($conn);
        }
    } else {
        $error = "กรุณากรอกข้อมูลให้ครบถ้วน";
    }
}
?>
<!DOCTYPE html>
<html lang="th">
<head>
<meta charset="UTF-8">
<title>เพิ่มอีเว้นท์ใหม่</title>
<link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Prompt:wght@400;600;700&display=swap" rel="stylesheet">
<style>
body {
    background: linear-gradient(135deg, #0d0d0d, #1a1a1a);
    color: #fff;
    font-family: 'Prompt', sans-serif; 
    line-height: 1.6;
}
.form-card {
    background: #141414;
    padding: 50px 45px;
    border-radius: 20px;
    box-shadow: 0 8px 30px rgba(0,0,0,0.75);
    max-width: 720px;
    margin: 70px auto;
}
.form-card h2 {
    color: #e53935;
    margin-bottom: 30px;
    font-weight: 700;
    font-size: 2.4rem;
    text-align: center;
    letter-spacing: 1px;
}
.form-control {
    background: #202020;
    border: 1px solid #333;
    color: #fff;
    border-radius: 12px;
    padding: 14px 16px;
    font-size: 1rem;
    transition: 0.3s;
    margin-bottom: 22px;
}
.form-control:focus {
    border-color: #e53935;
    box-shadow: 0 0 0 0.25rem rgba(229,57,53,.35);
    background: #1a1a1a;
    color: #fff;
}
label {
    font-weight: 600;
    margin-bottom: 8px;
    display: block;
    color: #ccc;
}
.btn-submit {
    background: linear-gradient(45deg,#e53935,#b71c1c);
    border: none;
    padding: 16px;
    border-radius: 35px;
    font-weight: 700;
    font-size: 1.2rem;
    transition: 0.3s;
    width: 100%;
    color: #fff;
    margin-top: 5px;
    font-family: 'Prompt', sans-serif; /* บังคับฟอนต์เหมือนฟอร์ม */
}
.btn-submit:hover { 
    transform: translateY(-2px); 
    opacity: 0.9; 
}
.btn-back { 
    margin-top: 25px; 
    border-radius: 30px; 
    font-weight: 600;
    background-color: #242424;
    border: 1px solid #444;
    color: #fff;
    transition: 0.3s;
    padding: 12px;
    display: block;
    text-align: center;
    text-decoration: none; 
}
.btn-back:hover {
    background-color: #e53935;
    border-color: #e53935;
    color: #fff;
}
.alert {
    border-radius: 12px;
    font-size: 0.95rem;
    margin-bottom: 25px;
}
</style>
</head>
<body>
  <div class="form-card">
    <h2>เพิ่มอีเว้นท์ใหม่</h2>
    <?php if(!empty($error)) echo "<div class='alert alert-danger'>$error</div>"; ?>
    <form method="post">
      <div>
        <label>ชื่ออีเว้นท์</label>
        <input type="text" name="title" class="form-control" required>
      </div>
      <div>
        <label>คำอธิบาย</label>
        <textarea name="detail" class="form-control" rows="4" required></textarea>
      </div>
      <div>
        <label>วันที่</label>
        <input type="date" name="date" class="form-control" required>
      </div>
      <div>
        <label>สถานที่</label>
        <input type="text" name="location" class="form-control" required>
      </div>
      <button type="submit" class="btn-submit">บันทึก</button>
    </form>
    <a href="manage_event.php" class="btn-back">กลับสู่แดชบอร์ด</a>
  </div>
</body>
</html>
