<?php
include __DIR__ . '/auth.php';
include __DIR__ . '/../db_connect.php';

$id = intval($_GET['id']);
$action = $_GET['action']; // approved / disapproved
$reason = isset($_POST['reason']) ? mysqli_real_escape_string($conn, $_POST['reason']) : '';

$status = ($action == 'approved') ? 'approved' : 'disapproved';

// ✅ Update ตาราง course
mysqli_query($conn, "UPDATE course SET status='$status' WHERE CourseID=$id");

// ✅ Insert ลง approval_history
mysqli_query($conn, "
    INSERT INTO approval_history (item_type, item_id, status, reason, created_at)
    VALUES ('course', $id, '$status', '$reason', NOW())
");

header("Location: manage_COURSE.php");
exit;
