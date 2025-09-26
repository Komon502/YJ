<?php
include 'auth.php';
include '../db_connect.php';

$type = $_GET['type'];
$id = intval($_GET['id']);
$action = $_GET['action'];

if ($action === "approve") {
    $status = "approved";
    $reason = null;
} else {
    // ถ้า disapprove ต้องใส่เหตุผล
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $status = "disapproved";
        $reason = mysqli_real_escape_string($conn, $_POST['reason']);
    } else {
        // ฟอร์มให้กรอกเหตุผล
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
                <a href="dashboard.php" class="btn btn-secondary">ยกเลิก</a>
            </form>
        </div>
        </body>
        </html>
        <?php
        exit();
    }
}

// update ตารางหลัก
$table = ($type === "course") ? "course" : "event";
$key   = ($type === "course") ? "CourseID" : "EventID";
mysqli_query($conn, "UPDATE $table SET status='$status' WHERE $key=$id");

// insert history
mysqli_query($conn, "INSERT INTO history (item_type, item_id, action, reason, owner, created_at) 
    VALUES ('$type', $id, '$status', " . ($reason ? "'$reason'" : "NULL") . ", '{$_SESSION['O_Username']}', NOW())");

header("Location: owner_dashboard.php");
exit();
?>
