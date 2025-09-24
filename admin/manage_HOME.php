<?php
session_start();
include 'db_connect.php';

// ถ้ายังไม่ได้ล็อกอิน → กลับไป login.php
if (!isset($_SESSION['A_Username'])) {
  header("Location: login.php");
  exit();
}

// ฟังก์ชันเช็ค path ของรูป
function getImagePath($fileName) {
  if (!empty($fileName) && file_exists(__DIR__ . "/../uploads/" . $fileName)) {
    return "../uploads/" . $fileName;
  }
  return "../image/no-image.png";
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

  $image = null;
  if (!empty($_FILES['image']['name'])) {
    $targetDir = __DIR__ . "/../uploads/";
    if (!is_dir($targetDir)) mkdir($targetDir, 0777, true);

    $fileName = time() . "_" . basename($_FILES['image']['name']);
    $targetFile = $targetDir . $fileName;

    if (move_uploaded_file($_FILES['image']['tmp_name'], $targetFile)) {
      $image = $fileName;
    } else {
      $error = "❌ Upload ล้มเหลว (Error Code: " . $_FILES['image']['error'] . ")";
    }
  }

  if ($title && $detail && $start && $end && $location) {
    $sql = "INSERT INTO event (E_Title, E_Detail, E_StartDate, E_EndDate, E_Location, E_Image) 
            VALUES ('$title','$detail','$start','$end','$location','$image')";
    if (mysqli_query($conn, $sql)) {
      $success = "✅ เพิ่มอีเว้นท์สำเร็จ!";
    } else {
      $error = "❌ เกิดข้อผิดพลาด: " . mysqli_error($conn);
    }
  }
}

// ✅ DELETE Event
if (isset($_GET['delete'])) {
  $id = intval($_GET['delete']);
  $res = mysqli_query($conn, "SELECT E_Image FROM event WHERE EventID=$id");
  $row = mysqli_fetch_assoc($res);

  if ($row && !empty($row['E_Image'])) {
    $filePath = __DIR__ . "/../uploads/" . $row['E_Image'];
    if (file_exists($filePath)) unlink($filePath);
  }

  $sql = "DELETE FROM event WHERE EventID=$id";
  if (mysqli_query($conn, $sql)) {
    $success = "🗑️ ลบอีเว้นท์สำเร็จ!";
  } else {
    $error = "❌ เกิดข้อผิดพลาด: " . mysqli_error($conn);
  }
}

$result = mysqli_query($conn, "SELECT * FROM event ORDER BY E_StartDate DESC");
?>
<!DOCTYPE html>
<html lang="th">
<head>
  <meta charset="UTF-8">
  <title>จัดการอีเว้นท์ - YJ Creating</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body { background:#000; color:#eee; font-family:'Prompt', sans-serif; padding:40px 15px; }
    .container { max-width:1000px; margin:auto; }
    h1 { text-align:center; font-size:2.2rem; font-weight:700; color:#ff5733; margin-bottom:30px; text-shadow:0 0 10px rgba(255,87,51,.7);}
    .card { background:#111; border-radius:18px; padding:30px; margin-bottom:40px; box-shadow:0 6px 20px rgba(255,87,51,0.2);}
    .card h4 { margin-bottom:20px; font-weight:600; color:#ff7043; border-bottom:1px solid rgba(255,87,51,0.3); padding-bottom:10px; text-align:center;}
    .form-control { background:#1a1a1a; border:1px solid #333; color:#fff; border-radius:10px; padding:14px 16px;}
    .btn-row { display:flex; justify-content:space-between; gap:15px; }
    .btn-success { background:linear-gradient(45deg,#43a047,#2e7d32); border:none; }
    .btn-danger { background:linear-gradient(45deg,#e53935,#b71c1c); border:none; }
    .btn-back { background:linear-gradient(45deg,#ff7043,#c22c0a); border:none; color:#fff; }
    table { background:#1a1a1a; border-radius:15px; overflow:hidden; }
    th { background:#ff5733; color:#fff; text-align:center; }
    td { text-align:center; color:#ddd; vertical-align:middle; }
    .event-img { width:100px; height:70px; object-fit:cover; border-radius:8px; }
  </style>
</head>
<body>
  <div class="container">
    <h1>📅 จัดการอีเว้นท์</h1>

    <?php if ($error) echo "<div class='alert alert-danger text-center'>$error</div>"; ?>
    <?php if ($success) echo "<div class='alert alert-success text-center'>$success</div>"; ?>

    <!-- Add Event -->
    <div class="card">
      <h4>➕ เพิ่มอีเว้นท์ใหม่</h4>
      <form method="post" enctype="multipart/form-data">
        <label>ชื่ออีเว้นท์</label>
        <input type="text" name="title" class="form-control" placeholder="เช่น Kids Market" required>
        <div class="row">
          <div class="col-md-6">
            <label>วันที่เริ่ม</label>
            <input type="date" name="start_date" class="form-control" required>
          </div>
          <div class="col-md-6">
            <label>วันที่สิ้นสุด</label>
            <input type="date" name="end_date" class="form-control" required>
          </div>
        </div>
        <label>สถานที่</label>
        <input type="text" name="location" class="form-control" placeholder="เช่น The Mall Korat" required>
        <label>รูปภาพ</label>
        <input type="file" name="image" class="form-control" accept="image/*">
        <label>รายละเอียด</label>
        <textarea name="detail" class="form-control" placeholder="รายละเอียดของอีเว้นท์" required></textarea>
        <div class="btn-row">
          <button type="submit" name="add" class="btn btn-success">บันทึก</button>
          <a href="admin_dashboard.php" class="btn btn-back">⬅ กลับแดชบอร์ด</a>
        </div>
      </form>
    </div>

    <!-- Event List -->
    <div class="card">
      <h4>📋 รายการอีเว้นท์</h4>
      <table class="table table-bordered table-dark align-middle">
        <thead>
          <tr>
            <th>ID</th><th>ภาพ</th><th>ชื่ออีเว้นท์</th><th>รายละเอียด</th><th>วันที่</th><th>สถานที่</th><th>การจัดการ</th>
          </tr>
        </thead>
        <tbody>
          <?php while ($row = mysqli_fetch_assoc($result)) { ?>
            <tr>
              <td><?= $row['EventID'] ?></td>
              <td><img src="<?= getImagePath($row['E_Image']) ?>" class="event-img"></td>
              <td><?= htmlspecialchars($row['E_Title']) ?></td>
              <td style="max-width:250px;"><?= htmlspecialchars($row['E_Detail']) ?></td>
              <td><?= $row['E_StartDate'] ?> - <?= $row['E_EndDate'] ?></td>
              <td><?= htmlspecialchars($row['E_Location']) ?></td>
              <td>
                <a href="edit_event.php?id=<?= $row['EventID'] ?>" class="btn btn-warning btn-sm">แก้ไข</a>
                <a href="?delete=<?= $row['EventID'] ?>" class="btn btn-danger btn-sm"
                   onclick="return confirm('คุณแน่ใจหรือไม่ที่จะลบอีเว้นท์นี้?');">ลบ</a>
              </td>
            </tr>
          <?php } ?>
        </tbody>
      </table>
    </div>
  </div>
</body>
</html>
