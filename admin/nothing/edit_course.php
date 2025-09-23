<?php
session_start();
include 'db_connect.php';

if (!isset($_SESSION['A_Username'])) {
    header("Location: login.php");
    exit();
}

if (!isset($_GET['id'])) {
    header("Location: manage_courses.php");
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
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $desc = mysqli_real_escape_string($conn, $_POST['description']);
    $duration = mysqli_real_escape_string($conn, $_POST['duration']);
    $fee = mysqli_real_escape_string($conn, $_POST['fee']);

    $sql = "UPDATE course SET CourseName='$name', Description='$desc', Duration='$duration', Fee='$fee' WHERE CourseID=$id";
    if (mysqli_query($conn, $sql)) {
        header("Location: manage_courses.php?msg=updated");
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
<link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
<!-- Google Fonts -->
<link href="https://fonts.googleapis.com/css2?family=Prompt:wght@400;600;700&family=Montserrat:wght@500;700&display=swap" rel="stylesheet">
<style>
/* ฟอนต์รวมทั้งฟอร์มและปุ่ม */
body, input, textarea, select, button, label {
    font-family: 'Prompt', sans-serif !important;
}
h2 {
    font-family: 'Prompt', 'Montserrat', sans-serif !important; /* ✅ แก้ตรงนี้ */
    color: #ff9800;
    margin-bottom: 30px;
    font-weight: 700;
    text-align: center;
}

/* พื้นหลังและฟอร์ม */
body {
    background: linear-gradient(135deg, #0f0f0f, #1c1c1c);
    color: #fff;
    margin: 0;
    padding: 0;
}
.form-card {
    background: #181818;
    padding: 40px 35px;
    border-radius: 20px;
    box-shadow: 0 8px 25px rgba(0,0,0,0.6);
    max-width: 600px;
    margin: 60px auto;
    border: 1px solid #333;
}
.form-card h2 {
    font-family: 'Prompt', 'Montserrat', sans-serif !important; /* ✅ ให้หัวข้อดูสวยทั้งไทย/อังกฤษ */
    color: #ff9800;
    margin-bottom: 30px;
    font-weight: 700;
    text-align: center;
}

/* Input & textarea */
.form-control {
    background: #222 !important;
    border: 1px solid #333 !important;
    color: #fff !important;
    border-radius: 12px !important;
    padding: 12px 14px !important;
    font-size: 1rem !important;
    margin-bottom: 18px !important;
    transition: all 0.3s;
}
.form-control:focus {
    border-color: #ff9800 !important;
    box-shadow: 0 0 0 0.2rem rgba(255,152,0,0.25) !important;
    background: #222 !important;
    color: #fff !important;
}
textarea.form-control {
    min-height: 120px !important;
    resize: vertical !important;
}

/* ปุ่ม */
.btn-submit {
    background: linear-gradient(45deg,#ff9800,#f57c00) !important;
    border: none !important;
    padding: 14px !important;
    border-radius: 30px !important;
    font-weight: 600 !important;
    font-size: 1rem !important;
    width: 100% !important;
    color: #fff !important;
    transition: 0.3s !important;
    cursor: pointer !important;
}
.btn-submit:hover {
    transform: translateY(-2px) !important;
    opacity: 0.9 !important;
}
.btn-back {
    background: #555 !important;
    padding: 10px 20px !important;
    width: auto !important;
    display: inline-block !important;
    margin-top: 12px !important;
    text-align: center !important;
    border-radius: 25px !important;
    font-size: 0.95rem !important;
    text-decoration: none !important;
    color: #fff !important;
    transition: 0.3s !important;
}
.btn-back:hover {
    background: #777 !important;
}

/* Error message */
.alert-danger {
    background-color: #a94442 !important;
    border-color: #843534 !important;
    color: #fff !important;
    border-radius: 12px !important;
    padding: 10px 12px !important;
    margin-bottom: 20px !important;
    font-size: 0.95rem !important;
}

/* Label */
label {
    font-weight: 600 !important;
    margin-bottom: 6px !important;
    display: block !important;
}
</style>
</head>
<body>
<div class="form-card">
    <h2>แก้ไขคอร์ส</h2>
    <?php if(!empty($error)) echo "<div class='alert alert-danger'>$error</div>"; ?>
    <form method="post">
        <div class="mb-3">
            <label>ชื่อคอร์ส</label>
            <input type="text" name="name" class="form-control" value="<?= htmlspecialchars($course['CourseName']) ?>" required>
        </div>
        <div class="mb-3">
            <label>คำอธิบาย</label>
            <textarea name="description" class="form-control" required><?= htmlspecialchars($course['Description']) ?></textarea>
        </div>
        <div class="mb-3">
            <label>ระยะเวลา</label>
            <input type="text" name="duration" class="form-control" value="<?= htmlspecialchars($course['Duration']) ?>" required>
        </div>
        <div class="mb-3">
            <label>ค่าใช้จ่าย</label>
            <input type="text" name="fee" class="form-control" value="<?= htmlspecialchars($course['Fee']) ?>" required>
        </div>
        <button type="submit" class="btn-submit">บันทึกการแก้ไข</button>
        <a href="manage_courses.php" class="btn-back">กลับ</a>
    </form>
</div>
</body>
</html>
