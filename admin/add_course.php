<?php
session_start();
include 'db_connect.php';

// ถ้ายังไม่ได้ล็อกอิน → กลับไป login
if (!isset($_SESSION['A_Username'])) {
    header("Location: login.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $CourseName = $_POST['CourseName'];
    $Category   = $_POST['Category'];
    $Description = $_POST['Description'];
    $Duration = $_POST['Duration'];
    $Fee = $_POST['Fee'];
    $Teacher = $_POST['Teacher'];

    // ✅ อัปโหลดรูป
    $image = null;
    if (!empty($_FILES['Image']['name'])) {
        $targetDir = "../uploads/";
        if (!is_dir($targetDir)) mkdir($targetDir, 0777, true);
        $image = time() . "_" . basename($_FILES["Image"]["name"]);
        $targetFile = $targetDir . $image;
        if (!move_uploaded_file($_FILES["Image"]["tmp_name"], $targetFile)) {
            $image = null;
        }
    }

    $sql = "INSERT INTO course (CourseName, Category, Description, Duration, Fee, Teacher, Image) 
            VALUES ('$CourseName', '$Category', '$Description', '$Duration', '$Fee', '$Teacher', '$image')";
    if (mysqli_query($conn, $sql)) {
        header("Location: manage_COURSE.php");
        exit();
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>
<!DOCTYPE html>
<html lang="th">
<head>
  <meta charset="UTF-8">
  <title>เพิ่มคอร์ส - YJ Creating</title>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
  <style>
    body { background:#0b0b0b; font-family:'Prompt',sans-serif; color:#fff; display:flex; justify-content:center; align-items:center; height:100vh; margin:0; }
    .form-container { background:#111; padding:30px; border-radius:15px; width:450px; box-shadow:0 8px 20px rgba(0,0,0,0.6); }
    h2 { color:#ff5733; text-align:center; margin-bottom:20px; }
    label { display:block; margin-top:15px; font-weight:500; }
    input, textarea, select { width:100%; padding:10px; margin-top:5px; border:none; border-radius:8px; background:#1a1a1a; color:#fff; }
    input[type="file"] { background:#000; }
    button { margin-top:20px; width:100%; padding:12px; border:none; border-radius:8px; background:#ff5733; color:#fff; font-size:1rem; font-weight:600; cursor:pointer; transition:.3s; }
    button:hover { background:#e74c3c; }
    a { display:inline-block; margin-top:10px; text-decoration:none; color:#ccc; }
    a:hover { color:#fff; }
  </style>
</head>
<body>
  <div class="form-container">
    <h2>เพิ่มคอร์สใหม่</h2>
    <form method="POST" enctype="multipart/form-data">
      <label>ชื่อคอร์ส</label>
      <input type="text" name="CourseName" required>

      <label>หมวดหมู่</label>
      <select name="Category" required>
        <option value="Web Development">Web Development</option>
        <option value="Digital Marketing">Digital Marketing</option>
        <option value="UI/UX Design">UI/UX Design</option>
        <option value="Data Science">Data Science</option>
        <option value="Music">Music</option>
        <option value="Language">Language</option>
        <option value="Media">Media</option>
      </select>

      <label>คำอธิบาย</label>
      <textarea name="Description" rows="4" required></textarea>

      <label>ระยะเวลา</label>
      <input type="text" name="Duration" placeholder="8 ชั่วโมง" required>

      <label>ค่าใช้จ่าย</label>
      <input type="number" name="Fee" required>

      <label>ครูผู้สอน</label>
      <input type="text" name="Teacher" required>

      <label>อัปโหลดรูปภาพ</label>
      <input type="file" name="Image" accept="image/*">

      <button type="submit">บันทึกคอร์ส</button>
    </form>
    <a href="manage_COURSE.php">⬅ กลับไปจัดการคอร์ส</a>
  </div>
</body>
</html>
