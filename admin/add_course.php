<?php
include __DIR__ . '/auth.php';
include __DIR__ . '/../db_connect.php';

$error = "";
$success = "";

if (isset($_POST['add'])) {
    $name     = mysqli_real_escape_string($conn, $_POST['CourseName']);
    $category = mysqli_real_escape_string($conn, $_POST['Category']);
    $desc     = mysqli_real_escape_string($conn, $_POST['Description']);
    $duration = mysqli_real_escape_string($conn, $_POST['Duration']);
    $fee      = floatval($_POST['Fee']);
    $teacher  = mysqli_real_escape_string($conn, $_POST['Teacher']);

    $image = null;
    if (!empty($_FILES['Image']['name'])) {
        $targetDir = __DIR__ . "/../uploads/";
        if (!is_dir($targetDir)) mkdir($targetDir, 0777, true);

        $fileName = time() . "_" . basename($_FILES['Image']['name']);
        $targetFile = $targetDir . $fileName;

        if (move_uploaded_file($_FILES['Image']['tmp_name'], $targetFile)) {
            $image = $fileName;
        }
    }

    if ($name && $category && $desc && $duration && $fee && $teacher) {
        $sql = "INSERT INTO course (CourseName, Category, Description, Duration, Fee, Teacher, Image, status) 
            VALUES ('$name','$category','$desc','$duration','$fee','$teacher','$image','pending')";
        if (mysqli_query($conn, $sql)) {
            $cid = mysqli_insert_id($conn);
            mysqli_query($conn, "INSERT INTO approval_history (item_type, item_id, status, reason, created_at) 
                           VALUES ('course', $cid, 'pending', '', NOW())");
            $success = "✅ เพิ่มคอร์สสำเร็จ (รอ Owner อนุมัติ)";
        } else {
            $error = "❌ เกิดข้อผิดพลาด: " . mysqli_error($conn);
        }
    }
}
