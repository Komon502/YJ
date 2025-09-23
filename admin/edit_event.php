<?php
session_start();
include 'db_connect.php';

// ถ้ายังไม่ได้ล็อกอิน
if (!isset($_SESSION['A_Username'])) {
    header("Location: login.php");
    exit();
}

$error = "";
$success = "";

// ✅ ดึงข้อมูล Event ที่จะถูกแก้ไข
if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $result = mysqli_query($conn, "SELECT * FROM event WHERE EventID=$id");
    $event = mysqli_fetch_assoc($result);

    if (!$event) {
        die("❌ ไม่พบข้อมูลอีเว้นท์นี้");
    }
} else {
    die("❌ ไม่ระบุ Event ID");
}

// ✅ Update Event
if (isset($_POST['update'])) {
    $title    = mysqli_real_escape_string($conn, $_POST['title']);
    $detail   = mysqli_real_escape_string($conn, $_POST['detail']);
    $start    = mysqli_real_escape_string($conn, $_POST['start_date']);
    $end      = mysqli_real_escape_string($conn, $_POST['end_date']);
    $location = mysqli_real_escape_string($conn, $_POST['location']);

    // อัพโหลดรูปใหม่ (ถ้ามี)
    $image = $event['E_Image'];
    if (!empty($_FILES['image']['name'])) {
        $targetDir = "uploads/";
        if (!is_dir($targetDir)) mkdir($targetDir);
        $fileName = time() . "_" . basename($_FILES['image']['name']);
        $targetFile = $targetDir . $fileName;

        if (move_uploaded_file($_FILES['image']['tmp_name'], $targetFile)) {
            $image = $fileName;
        }
    }

    $sql = "UPDATE event 
            SET E_Title='$title', E_Detail='$detail', E_StartDate='$start', 
                E_EndDate='$end', E_Location='$location', E_Image='$image'
            WHERE EventID=$id";

    if (mysqli_query($conn, $sql)) {
        $success = "✅ แก้ไขอีเว้นท์สำเร็จ!";
        // โหลดข้อมูลใหม่
        $result = mysqli_query($conn, "SELECT * FROM event WHERE EventID=$id");
        $event = mysqli_fetch_assoc($result);
    } else {
        $error = "❌ เกิดข้อผิดพลาด: " . mysqli_error($conn);
    }
}
?>
<!DOCTYPE html>
<html lang="th">
<head>
<meta charset="UTF-8">
<title>แก้ไขอีเว้นท์ - YJ Creating</title>
<link href="https://fonts.googleapis.com/css2?family=Prompt:wght@300;400;600;700&display=swap" rel="stylesheet">
<link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
<style>
    body {
        background: #000;
        color: #eee;
        font-family: 'Prompt', sans-serif;
        display: flex;
        justify-content: center;
        align-items: flex-start;
        min-height: 100vh;
        padding: 40px 10px;
    }
    .container {
        max-width: 700px;
        width: 100%;
    }
    h1 {
        text-align: center;
        font-weight: 700;
        font-size: 2rem;
        color: #ff5733;
        margin-bottom: 25px;
    }
    .card {
        background: #111;
        border-radius: 18px;
        padding: 25px;
        box-shadow: 0 8px 25px rgba(255,87,51,0.25);
    }
    .form-control {
        background: #1a1a1a;
        border: 1px solid #333;
        color: #fff;
        border-radius: 10px;
        padding: 10px;
    }
    .form-control:focus {
        border-color: #ff5733;
        box-shadow: 0 0 10px rgba(255,87,51,0.6);
    }
    .btn {
        border-radius: 25px;
        padding: 8px 20px;
        font-weight: 600;
        transition: 0.3s;
    }
    .btn-success {
        background: linear-gradient(45deg,#43a047,#2e7d32);
        border: none;
        color: #fff;
    }
    .btn-success:hover { transform: scale(1.05); }
    .btn-secondary { background:#333; border:none; }
    .event-img {
        width: 120px;
        border-radius: 10px;
        margin-bottom: 10px;
    }
</style>
</head>
<body>
    <div class="container">
        <h1>✏️ แก้ไขอีเว้นท์</h1>

        <?php if(!empty($error)) echo "<div class='alert alert-danger'>$error</div>"; ?>
        <?php if(!empty($success)) echo "<div class='alert alert-success'>$success</div>"; ?>

        <div class="card">
            <form method="post" enctype="multipart/form-data">
                <div class="mb-3">
                    <label>ชื่ออีเว้นท์</label>
                    <input type="text" name="title" class="form-control" value="<?= htmlspecialchars($event['E_Title']) ?>" required>
                </div>
                <div class="mb-3">
                    <label>วันที่เริ่ม - วันที่จบ</label>
                    <div class="row">
                        <div class="col-md-6"><input type="date" name="start_date" class="form-control" value="<?= $event['E_StartDate'] ?>" required></div>
                        <div class="col-md-6"><input type="date" name="end_date" class="form-control" value="<?= $event['E_EndDate'] ?>" required></div>
                    </div>
                </div>
                <div class="mb-3">
                    <label>สถานที่</label>
                    <input type="text" name="location" class="form-control" value="<?= htmlspecialchars($event['E_Location']) ?>" required>
                </div>
                <div class="mb-3">
                    <label>รายละเอียด</label>
                    <textarea name="detail" class="form-control" rows="3" required><?= htmlspecialchars($event['E_Detail']) ?></textarea>
                </div>
                <div class="mb-3">
                    <label>รูปภาพปัจจุบัน</label><br>
                    <?php if($event['E_Image']) { ?>
                        <img src="uploads/<?= $event['E_Image'] ?>" class="event-img">
                    <?php } else { ?>
                        <p>❌ ไม่มีรูปภาพ</p>
                    <?php } ?>
                </div>
                <div class="mb-3">
                    <label>เลือกรูปใหม่ (ถ้าต้องการเปลี่ยน)</label>
                    <input type="file" name="image" class="form-control">
                </div>
                <button type="submit" name="update" class="btn btn-success">บันทึกการแก้ไข</button>
                <a href="manage_HOME.php" class="btn btn-secondary">⬅️ กลับ</a>
            </form>
        </div>
    </div>
<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>
