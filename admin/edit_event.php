<?php
include __DIR__ . '/auth.php';
include __DIR__ . '/../db_connect.php';

$id = intval($_GET['id']);
$error = "";
$success = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $title = mysqli_real_escape_string($conn, $_POST['E_Title']);
  $detail = mysqli_real_escape_string($conn, $_POST['E_Detail']);
  $start = $_POST['E_StartDate'];
  $end = $_POST['E_EndDate'];
  $location = mysqli_real_escape_string($conn, $_POST['E_Location']);

  $image = $_POST['old_image'];
  if (!empty($_FILES['E_Image']['name'])) {
    $targetDir = __DIR__ . "/../uploads/";
    $fileName = time() . "_" . basename($_FILES['E_Image']['name']);
    $targetFile = $targetDir . $fileName;

    if (move_uploaded_file($_FILES['E_Image']['tmp_name'], $targetFile)) {
      $image = $fileName;
    }
  }

  $sql = "UPDATE event 
            SET E_Title='$title', E_Detail='$detail', E_StartDate='$start', E_EndDate='$end',
                E_Location='$location', E_Image='$image', status='pending'
            WHERE EventID=$id";

  if (mysqli_query($conn, $sql)) {
    $success = "✅ แก้ไข Event สำเร็จ (รอ Owner อนุมัติ)";

    // ✅ Insert หรือ Update ลง approval_history
    $eid = $id;
    mysqli_query($conn, "
        INSERT INTO approval_history (item_type, item_id, status, reason, created_at)
        VALUES ('event', $eid, 'pending', '', NOW())
        ON DUPLICATE KEY UPDATE 
            status='pending',
            reason='',
            created_at=NOW()
    ");
  } else {
    $error = "❌ เกิดข้อผิดพลาด: " . mysqli_error($conn);
  }
}

$result = mysqli_query($conn, "SELECT * FROM event WHERE EventID=$id");
$event = mysqli_fetch_assoc($result);
?>
<!DOCTYPE html>
<html lang="th">
<head>
  <meta charset="UTF-8">
  <title>แก้ไข Event</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="public/style.css">
  <link rel="stylesheet" href="public/admin_event_edit.css">
</head>
<body>
  <div class="container py-5">
    <h1>✏️ แก้ไข Event</h1>

    <?php if ($error) echo "<div class='alert alert-danger'>$error</div>"; ?>
    <?php if ($success) echo "<div class='alert alert-success'>$success</div>"; ?>

    <form method="post" enctype="multipart/form-data">
      <div class="mb-3">
        <label>ชื่อ Event</label>
        <input type="text" name="E_Title" class="form-control" value="<?= htmlspecialchars($event['E_Title']) ?>" required>
      </div>
      <div class="mb-3">
        <label>รายละเอียด</label>
        <textarea name="E_Detail" class="form-control" required><?= htmlspecialchars($event['E_Detail']) ?></textarea>
      </div>
      <div class="row mb-3">
        <div class="col-md-6">
          <label>วันที่เริ่ม</label>
          <input type="date" name="E_StartDate" class="form-control" value="<?= $event['E_StartDate'] ?>" required>
        </div>
        <div class="col-md-6">
          <label>วันที่สิ้นสุด</label>
          <input type="date" name="E_EndDate" class="form-control" value="<?= $event['E_EndDate'] ?>" required>
        </div>
      </div>
      <div class="mb-3">
        <label>สถานที่</label>
        <input type="text" name="E_Location" class="form-control" value="<?= htmlspecialchars($event['E_Location']) ?>" required>
      </div>
      <div class="mb-3">
        <label>รูปภาพ</label><br>
        <?php if ($event['E_Image']) { ?>
          <img src="../uploads/<?= $event['E_Image'] ?>" width="120" class="mb-2"><br>
        <?php } ?>
        <input type="hidden" name="old_image" value="<?= $event['E_Image'] ?>">
        <input type="file" name="E_Image" class="form-control" accept="image/*">
      </div>
      <button type="submit" class="btn btn-success">บันทึก</button>
      <a href="manage_HOME.php" class="btn btn-secondary">⬅ กลับไปจัดการ Event</a>
    </form>
  </div>
</body>
</html>
