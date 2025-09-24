<?php
session_start();
include 'db_connect.php';

// ถ้าไม่ได้ login → กลับไป login.php
if (!isset($_SESSION['A_Username'])) {
    header("Location: login.php");
    exit();
}

// ถ้าไม่มี id → กลับไป manage_HOME.php
if (!isset($_GET['id'])) {
    header("Location: manage_HOME.php");
    exit();
}

$id = intval($_GET['id']);
$result = mysqli_query($conn, "SELECT * FROM event WHERE EventID=$id");
$event = mysqli_fetch_assoc($result);

if (!$event) {
    echo "❌ ไม่พบอีเว้นท์";
    exit();
}

$error = "";

// ✅ UPDATE Event
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title    = mysqli_real_escape_string($conn, $_POST['title']);
    $detail   = mysqli_real_escape_string($conn, $_POST['detail']);
    $start    = mysqli_real_escape_string($conn, $_POST['start_date']);
    $end      = mysqli_real_escape_string($conn, $_POST['end_date']);
    $location = mysqli_real_escape_string($conn, $_POST['location']);

    $image = $event['E_Image'];
    if (!empty($_FILES['image']['name'])) {
        $targetDir = __DIR__ . "/../uploads/";
        if (!is_dir($targetDir)) mkdir($targetDir, 0777, true);

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
        header("Location: manage_HOME.php?msg=updated");
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
    <title>แก้ไขอีเว้นท์ - YJ</title>
    <link href="https://fonts.googleapis.com/css2?family=Prompt:wght@300;400;600;700&display=swap" rel="stylesheet">
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background:#000; font-family:'Prompt', sans-serif; color: #fff; display:flex; justify-content:center; padding:40px 15px;}
        .form-card { background:#111; padding:40px; border-radius:20px; max-width:700px; width:100%; box-shadow:0 6px 20px rgba(255,87,51,0.3);}
        .form-card h2 { text-align:center; color:#ff5733; margin-bottom:25px; font-weight:700; text-shadow:0 0 10px rgba(255,87,51,0.5);}
        .form-control { background:#1a1a1a; border:1px solid #333; color:#fff; border-radius:10px; padding:12px; margin-bottom:18px;}
        .form-control:focus { border-color:#ff5733; box-shadow:0 0 10px rgba(255,87,51,0.7);}
        textarea.form-control { min-height:120px; resize:vertical;}
        label { font-weight:600; margin-bottom:6px; }
        .btn-submit { background:linear-gradient(45deg,#ff9800,#f57c00); border:none; padding:12px; border-radius:25px; font-weight:600; width:100%; color:#fff; transition:0.3s;}
        .btn-submit:hover { opacity:0.9; transform:translateY(-2px);}
        .btn-back { background:#555; padding:10px 20px; border-radius:25px; color:#fff; text-decoration:none; display:inline-block; margin-top:15px;}
        .btn-back:hover { background:#777;}
        .event-img { width:160px; height:100px; object-fit:cover; border-radius:10px; margin-top:10px;}
    </style>
</head>
<body>
    <div class="form-card">
        <h2>✏️ แก้ไขอีเว้นท์</h2>
        <?php if (!empty($error)) echo "<div class='alert alert-danger'>$error</div>"; ?>

        <form method="post" enctype="multipart/form-data">
            <label>ชื่ออีเว้นท์</label>
            <input type="text" name="title" class="form-control" value="<?= htmlspecialchars($event['E_Title']) ?>" required>

            <div class="row">
                <div class="col-md-6">
                    <label>วันที่เริ่ม</label>
                    <input type="date" name="start_date" class="form-control" value="<?= $event['E_StartDate'] ?>" required>
                </div>
                <div class="col-md-6">
                    <label>วันที่สิ้นสุด</label>
                    <input type="date" name="end_date" class="form-control" value="<?= $event['E_EndDate'] ?>" required>
                </div>
            </div>
            <label>สถานที่</label>
            <input type="text" name="location" class="form-control" value="<?= htmlspecialchars($event['E_Location']) ?>" required>
<br>
            <label>รายละเอียด</label>
            <br>
            <textarea name="detail" class="form-control" required><?= htmlspecialchars($event['E_Detail']) ?></textarea>
<br>
            <label>รูปภาพปัจจุบัน</label><br>
            <?php if ($event['E_Image'] && file_exists(__DIR__ . "/../uploads/" . $event['E_Image'])) { ?>
                <img src="../uploads/<?= $event['E_Image'] ?>" class="event-img">
            <?php } else { ?>
                <p>❌ ไม่มีรูปภาพ</p>
            <?php } ?>
<br>
            <label>อัปโหลดรูปใหม่ (ถ้าต้องการเปลี่ยน)</label>
            <input type="file" name="image" class="form-control">

            <button type="submit" class="btn-submit">บันทึกการแก้ไข</button>
            <a href="manage_HOME.php" class="btn-back">⬅ กลับ</a>
        </form>
    </div>
</body>
</html>
