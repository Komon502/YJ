<?php
include __DIR__ . '/auth.php';
include __DIR__ . '/../db_connect.php';

$error = "";
$success = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = mysqli_real_escape_string($conn, $_POST['CourseName']);
    $category = mysqli_real_escape_string($conn, $_POST['Category']);
    $description = mysqli_real_escape_string($conn, $_POST['Description']);
    $duration = mysqli_real_escape_string($conn, $_POST['Duration']);
    $fee = floatval($_POST['Fee']);
    $teacher = mysqli_real_escape_string($conn, $_POST['Teacher']);

    $image = null;
    if (!empty($_FILES['Image']['name'])) {
        $targetDir = __DIR__ . "/../uploads/";
        if (!is_dir($targetDir)) mkdir($targetDir, 0777, true);

        $fileName = time() . "_" . basename($_FILES['Image']['name']);
        $targetFile = $targetDir . $fileName;

        if (move_uploaded_file($_FILES['Image']['tmp_name'], $targetFile)) {
            $image = $fileName;
        } else {
            $error = "❌ Upload ล้มเหลว";
        }
    }

    if ($name && $category && $description && $duration && $fee && $teacher) {
        $sql = "INSERT INTO course (CourseName, Category, Description, Duration, Fee, Teacher, Image, status) 
                VALUES ('$name','$category','$description','$duration','$fee','$teacher','$image','pending')";
        if (mysqli_query($conn, $sql)) {
            $success = "✅ เพิ่มคอร์สสำเร็จ (รอ Owner อนุมัติ)";
        } else {
            $error = "❌ เกิดข้อผิดพลาด: " . mysqli_error($conn);
        }
    }
}
?>
