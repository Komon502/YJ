<?php
session_start();
include 'auth.php';
include '../db_connect.php';

$type   = $_GET['type'];     // course หรือ event
$id     = intval($_GET['id']);
$action = $_GET['action'];   // approve หรือ disapprove

if ($action === "approve") {
    $status = "approved";
    $reason = null;
} else {
    // ถ้าเป็น disapprove ต้องกรอกเหตุผล
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $status = "disapproved";
        $reason = mysqli_real_escape_string($conn, $_POST['reason']);
    } else {
        // แสดงฟอร์มกรอกเหตุผล
        ?>
        <!DOCTYPE html>
        <html lang="th">
        <head>
            <meta charset="UTF-8">
            <title>Disapprove</title>
            <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
        </head>
        <body class="bg-dark text-white">
        <div class="container py-5">
            <h2 class="text-danger">❌ ใส่เหตุผลที่ Disapprove</h2>
            <form method="post">
                <textarea name="reason" class="form-control mb-3" placeholder="กรอกเหตุผล..." required></textarea>
                <button type="submit" class="btn btn-danger">ยืนยัน Disapprove</button>
                <a href="owner_dashboard.php" class="btn btn-secondary">ยกเลิก</a>
            </form>
        </div>
        </body>
        </html>
        <?php
        exit();
    }
}

// ✅ update ตารางหลัก (course/event)
$table = ($type === "course") ? "course" : "event";
$key   = ($type === "course") ? "CourseID" : "EventID";
mysqli_query($conn, "UPDATE $table SET status='$status' WHERE $key=$id");

// ✅ insert ลง history (ฝั่ง Owner ใช้ดู)
mysqli_query($conn, "
    INSERT INTO history (item_type, item_id, action, reason, owner, created_at) 
    VALUES ('$type', $id, '$status', " . ($reason ? "'$reason'" : "NULL") . ", '{$_SESSION['O_Username']}', NOW())
");

// ✅ insert/update ลง approval_history (ฝั่ง Admin ใช้ดู)
mysqli_query($conn, "
    INSERT INTO approval_history (item_type, item_id, status, reason, created_at)
    VALUES ('$type', $id, '$status', " . ($reason ? "'$reason'" : "NULL") . ", NOW())
    ON DUPLICATE KEY UPDATE 
        status='$status', 
        reason=" . ($reason ? "'$reason'" : "NULL") . ", 
        created_at=NOW()
");

header("Location: owner_dashboard.php");
exit();
