<?php
include __DIR__ . '/auth.php';
include __DIR__ . '/../db_connect.php';

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    
    // ✅ ลบไฟล์รูปออกจาก uploads
    $res = mysqli_query($conn, "SELECT Image FROM course WHERE CourseID=$id");
    if ($row = mysqli_fetch_assoc($res)) {
        if (!empty($row['Image'])) {
            $filePath = __DIR__ . "/../uploads/" . $row['Image'];
            if (file_exists($filePath)) unlink($filePath);
        }
    }

    // ✅ ลบคอร์สออกจาก DB
    mysqli_query($conn, "DELETE FROM course WHERE CourseID=$id");
}

// ✅ กลับไปหน้า manage_COURSE.php
header("Location: manage_COURSE.php");
exit;
?>
