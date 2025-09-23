<?php
session_start();
include 'db_connect.php';

// ถ้ายังไม่ได้ล็อกอิน → กลับไป login.php
if (!isset($_SESSION['A_Username'])) {
    header("Location: login.php");
    exit();
}

$error = "";
$success = "";

// ✅ ADD Event
if (isset($_POST['add'])) {
    $title    = mysqli_real_escape_string($conn, $_POST['title']);
    $detail   = mysqli_real_escape_string($conn, $_POST['detail']);
    $start    = mysqli_real_escape_string($conn, $_POST['start_date']);
    $end      = mysqli_real_escape_string($conn, $_POST['end_date']);
    $location = mysqli_real_escape_string($conn, $_POST['location']);

    // อัพโหลดรูป
    $image = null;
    if (!empty($_FILES['image']['name'])) {
        $targetDir = "uploads/";
        if (!is_dir($targetDir)) mkdir($targetDir);
        $fileName = time() . "_" . basename($_FILES['image']['name']);
        $targetFile = $targetDir . $fileName;

        if (move_uploaded_file($_FILES['image']['tmp_name'], $targetFile)) {
            $image = $fileName;
        }
    }

    if (!empty($title) && !empty($detail) && !empty($start) && !empty($end) && !empty($location)) {
        $sql = "INSERT INTO event (E_Title, E_Detail, E_StartDate, E_EndDate, E_Location, E_Image) 
                VALUES ('$title','$detail','$start','$end','$location','$image')";
        if (mysqli_query($conn, $sql)) $success = "✅ เพิ่มอีเว้นท์สำเร็จ!";
        else $error = "❌ เกิดข้อผิดพลาด: " . mysqli_error($conn);
    } else $error = "⚠️ กรุณากรอกข้อมูลให้ครบถ้วน";
}

// ✅ DELETE Event
if (isset($_GET['delete'])) {
    $id = intval($_GET['delete']);
    $sql = "DELETE FROM event WHERE EventID=$id";
    if (mysqli_query($conn, $sql)) $success = "🗑️ ลบอีเว้นท์สำเร็จ!";
    else $error = "❌ เกิดข้อผิดพลาด: " . mysqli_error($conn);
}

// ✅ GET Events
$result = mysqli_query($conn, "SELECT * FROM event ORDER BY E_StartDate DESC");
?>
<!DOCTYPE html>
<html lang="th">
<head>
<meta charset="UTF-8">
<title>จัดการอีเว้นท์ - YJ Creating</title>
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
        max-width: 1000px;
        width: 100%;
    }
    h1 {
        text-align: center;
        font-weight: 700;
        font-size: 2.2rem;
        color: #ff5733;
        margin-bottom: 30px;
    }
    .card {
        background: #111;
        border-radius: 18px;
        padding: 25px;
        margin-bottom: 30px;
        box-shadow: 0 8px 25px rgba(255,87,51,0.25);
    }
    .card h4 {
        margin-bottom: 20px;
        font-weight: 600;
        color: #ff7043;
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
    .btn-warning {
        background: linear-gradient(45deg,#ffb74d,#ff9800);
        border: none;
        color: #000;
    }
    .btn-danger {
        background: linear-gradient(45deg,#e53935,#b71c1c);
        border: none;
        color: #fff;
    }
    .btn-secondary { background:#333; border:none; }
    table {
        background: #1a1a1a;
        border-radius: 15px;
        overflow: hidden;
        box-shadow: 0 6px 20px rgba(0,0,0,0.6);
    }
    th {
        background: #ff5733;
        color: #fff;
        text-align: center;
        font-weight: 600;
    }
    td { text-align: center; vertical-align: middle; }
    tr:hover { background: rgba(255,255,255,0.05); }
    .event-img {
        width: 90px;
        height: 60px;
        object-fit: cover;
        border-radius: 8px;
    }
</style>
</head>
<body>
    <div class="container">
        <h1>📅 จัดการอีเว้นท์</h1>

        <!-- Alert -->
        <?php if(!empty($error)) echo "<div class='alert alert-danger'>$error</div>"; ?>
        <?php if(!empty($success)) echo "<div class='alert alert-success'>$success</div>"; ?>

        <!-- Add Event -->
        <div class="card">
            <h4>➕ เพิ่มอีเว้นท์ใหม่</h4>
            <form method="post" enctype="multipart/form-data">
                <div class="row mb-3">
                    <div class="col-md-6"><input type="text" name="title" class="form-control" placeholder="ชื่ออีเว้นท์" required></div>
                    <div class="col-md-3"><input type="date" name="start_date" class="form-control" required></div>
                    <div class="col-md-3"><input type="date" name="end_date" class="form-control" required></div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-6"><input type="text" name="location" class="form-control" placeholder="สถานที่" required></div>
                    <div class="col-md-6"><input type="file" name="image" class="form-control"></div>
                </div>
                <div class="mb-3"><textarea name="detail" class="form-control" placeholder="รายละเอียด" rows="3" required></textarea></div>
                <button type="submit" name="add" class="btn btn-success">บันทึก</button>
                <a href="admin_dashboard.php" class="btn btn-secondary">กลับแดชบอร์ด</a>
            </form>
        </div>

        <!-- Table -->
        <div class="card">
            <h4>📋 รายการอีเว้นท์</h4>
            <table class="table table-bordered table-dark align-middle">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>ภาพ</th>
                        <th>ชื่ออีเว้นท์</th>
                        <th>รายละเอียด</th>
                        <th>วันที่</th>
                        <th>สถานที่</th>
                        <th>การจัดการ</th>
                    </tr>
                </thead>
                <tbody>
                <?php while($row = mysqli_fetch_assoc($result)) { ?>
                    <tr>
                        <td><?= $row['EventID'] ?></td>
                        <td>
                            <?php if($row['E_Image']) { ?>
                                <img src="uploads/<?= $row['E_Image'] ?>" class="event-img">
                            <?php } else { ?>
                                ❌
                            <?php } ?>
                        </td>
                        <td><?= htmlspecialchars($row['E_Title']) ?></td>
                        <td><?= htmlspecialchars($row['E_Detail']) ?></td>
                        <td><?= $row['E_StartDate'] ?> - <?= $row['E_EndDate'] ?></td>
                        <td><?= htmlspecialchars($row['E_Location']) ?></td>
                        <td>
                            <a href="edit_event.php?id=<?= $row['EventID'] ?>" class="btn btn-warning btn-sm">✏️ แก้ไข</a>
                            <a href="?delete=<?= $row['EventID'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('คุณแน่ใจหรือไม่ที่จะลบอีเว้นท์นี้?');">🗑️ ลบ</a>
                        </td>
                    </tr>
                <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>
