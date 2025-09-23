<?php
session_start();
include 'db_connect.php';

if (!isset($_SESSION['A_Username'])) {
    header("Location: login.php");
    exit();
}

if (!isset($_GET['id'])) {
    header("Location: manage_COURSE.php");
    exit();
}

$id = intval($_GET['id']);
$result = mysqli_query($conn, "SELECT * FROM course WHERE CourseID=$id");
$course = mysqli_fetch_assoc($result);

if (!$course) {
    echo "❌ ไม่พบคอร์ส";
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $CourseName = mysqli_real_escape_string($conn, $_POST['CourseName']);
    $Category = mysqli_real_escape_string($conn, $_POST['Category']);
    $Description = mysqli_real_escape_string($conn, $_POST['Description']);
    $Duration = mysqli_real_escape_string($conn, $_POST['Duration']);
    $Fee = mysqli_real_escape_string($conn, $_POST['Fee']);
    $Teacher = mysqli_real_escape_string($conn, $_POST['Teacher']);

    // ✅ เช็คอัปโหลดรูปใหม่
    $image = $course['Image'];
    if (!empty($_FILES['Image']['name'])) {
        $targetDir = "../uploads/";
        if (!is_dir($targetDir)) mkdir($targetDir, 0777, true);

        $image = time() . "_" . basename($_FILES["Image"]["name"]);
        $targetFile = $targetDir . $image;
        move_uploaded_file($_FILES["Image"]["tmp_name"], $targetFile);
    }

    $sql = "UPDATE course 
            SET CourseName='$CourseName', Category='$Category', Description='$Description', 
                Duration='$Duration', Fee='$Fee', Teacher='$Teacher', Image='$image' 
            WHERE CourseID=$id";

    if (mysqli_query($conn, $sql)) {
        header("Location: manage_COURSE.php?msg=updated");
        exit();
    } else {
        $error = "❌ Error: " . mysqli_error($conn);
    }
}
?>
<!DOCTYPE html>
<html lang="th">
<head>
<meta charset="UTF-8">
<title>แก้ไขคอร์ส - YJ</title>
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Prompt:wght@400;600;700&display=swap" rel="stylesheet">
<style>
body {
  background: #0b0b0b;
  font-family: 'Prompt', sans-serif;
  color: #fff;
  display: flex;
  justify-content: center;
  align-items: flex-start;
  min-height: 100vh;
  margin: 0;
  padding: 40px 0;
}
.form-container {
  background: #111;
  padding: 30px;
  border-radius: 15px;
  width: 450px;
  box-shadow: 0 8px 20px rgba(0,0,0,0.6);
}
h2 {
  color: #ff5733;
  text-align: center;
  margin-bottom: 20px;
}
label {
  display: block;
  margin-top: 15px;
  font-weight: 500;
}
input, textarea, select {
  width: 100%;
  padding: 10px;
  margin-top: 5px;
  border: none;
  border-radius: 8px;
  background: #1a1a1a;
  color: #fff;
}
input[type="file"] {
  background: #000;
}
button {
  margin-top: 20px;
  width: 100%;
  padding: 12px;
  border: none;
  border-radius: 8px;
  background: #ff5733;
  color: #fff;
  font-size: 1rem;
  font-weight: 600;
  cursor: pointer;
  transition: .3s;
}
button:hover {
  background: #e74c3c;
}
a {
  display: inline-block;
  margin-top: 10px;
  text-decoration: none;
  color: #ccc;
}
a:hover {
  color: #fff;
}
img.preview {
  margin-top: 10px;
  max-width: 100%;
  border-radius: 10px;
}
</style>
</head>
<body>
  <div class="form-container">
    <h2>✏️ แก้ไขคอร์ส</h2>
    <form method="POST" enctype="multipart/form-data">
      <label>ชื่อคอร์ส</label>
      <input type="text" name="CourseName" value="<?= htmlspecialchars($course['CourseName']) ?>" required>

      <label>หมวดหมู่</label>
      <select name="Category" required>
        <?php
        $categories = ["Web Development","Digital Marketing","UI/UX Design","Data Science","Music","Language","Media"];
        foreach ($categories as $cat) {
            $selected = ($course['Category'] == $cat) ? "selected" : "";
            echo "<option value='$cat' $selected>$cat</option>";
        }
        ?>
      </select>

      <label>คำอธิบาย</label>
      <textarea name="Description" rows="4" required><?= htmlspecialchars($course['Description']) ?></textarea>

      <label>ระยะเวลา</label>
      <input type="text" name="Duration" value="<?= htmlspecialchars($course['Duration']) ?>" required>

      <label>ค่าใช้จ่าย</label>
      <input type="number" name="Fee" value="<?= htmlspecialchars($course['Fee']) ?>" required>

      <label>ครูผู้สอน</label>
      <input type="text" name="Teacher" value="<?= htmlspecialchars($course['Teacher']) ?>" required>

      <label>อัปโหลดรูปใหม่ (ถ้ามี)</label>
      <input type="file" name="Image" accept="image/*">

      <?php if ($course['Image']) { ?>
        <label>📌 รูปปัจจุบัน:</label>
        <img src="../uploads/<?= $course['Image'] ?>" class="preview">
      <?php } ?>

      <button type="submit">บันทึกการแก้ไข</button>
    </form>
    <a href="manage_COURSE.php">⬅ กลับไปจัดการคอร์ส</a>
  </div>
</body>
</html>
