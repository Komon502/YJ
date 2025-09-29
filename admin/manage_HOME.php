<?php
include __DIR__ . '/auth.php';
include __DIR__ . '/../db_connect.php';

// ฟังก์ชันดึง path ของรูป
function getImagePath($fileName)
{
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
    }
  }

  if ($title && $detail && $start && $end && $location) {
    $sql = "INSERT INTO event (E_Title, E_Detail, E_StartDate, E_EndDate, E_Location, E_Image, status) 
            VALUES ('$title','$detail','$start','$end','$location','$image','pending')";
    if (mysqli_query($conn, $sql)) {
      $eid = mysqli_insert_id($conn); // ดึง ID ล่าสุด
      mysqli_query($conn, "INSERT INTO approval_history (item_type, item_id, status, reason, created_at) 
                           VALUES ('event', $eid, 'pending', '', NOW())");
      $success = "✅ เพิ่มอีเว้นท์สำเร็จ (รอ Owner อนุมัติ)";
    } else {
      $error = "❌ เกิดข้อผิดพลาด: " . mysqli_error($conn);
    }
  }
}


$result = mysqli_query($conn, "SELECT * FROM event ORDER BY EventID DESC");
?>
<!DOCTYPE html>
<html lang="th">

<head>
  <meta charset="UTF-8">
  <title>จัดการอีเว้นท์</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
 <link rel="stylesheet" href="public/admin_home.css">

</head>

<body>
  <div class="container">
    <h1>📅 จัดการอีเว้นท์</h1>
    <a href="admin_dashboard.php" class="btn btn-back mb-3">⬅ กลับแดชบอร์ด</a>

    <!-- Add Event -->
    <div class="card">
      <h4>➕ เพิ่มอีเว้นท์ใหม่</h4>
      <?php if ($error) echo "<div class='alert alert-danger'>$error</div>"; ?>
      <?php if ($success) echo "<div class='alert alert-success'>$success</div>"; ?>
      <form method="post" enctype="multipart/form-data">
        <label>ชื่ออีเว้นท์</label>
        <input type="text" name="title" class="form-control" required>
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
        <input type="text" name="location" class="form-control" required>
        <label>รูปภาพ</label>
        <input type="file" name="image" class="form-control" accept="image/*">
        <label>รายละเอียด</label>
        <textarea name="detail" class="form-control" required></textarea>
        <button type="submit" name="add" class="btn btn-success mt-3">บันทึก</button>
      </form>
    </div>

    <!-- Event List -->
    <div class="card">
      <h4>📋 รายการอีเว้นท์</h4>
      <table class="table table-dark table-bordered align-middle">
        <thead>
          <tr>
            <th>ID</th>
            <th>ภาพ</th>
            <th>ชื่อ</th>
            <th>วันที่</th>
            <th>สถานที่</th>
            <th>สถานะ</th>
            <th>การจัดการ</th>
          </tr>
        </thead>
        <tbody>
          <?php while ($row = mysqli_fetch_assoc($result)) { ?>
            <tr>
              <td><?= $row['EventID'] ?></td>
              <td><img src="<?= getImagePath($row['E_Image']) ?>" class="event-img"></td>
              <td><?= htmlspecialchars($row['E_Title']) ?></td>
              <td><?= $row['E_StartDate'] ?> - <?= $row['E_EndDate'] ?></td>
              <td><?= htmlspecialchars($row['E_Location']) ?></td>
              <td>
                <?php if ($row['status'] == 'approved'): ?>
                  <span class="badge bg-success">✅ Approved</span>
                <?php elseif ($row['status'] == 'pending'): ?>
                  <span class="badge bg-warning text-dark">⏳ Pending</span>
                <?php else: ?>
                  <span class="badge bg-danger">❌ Disapproved</span>
                  <?php
                  $eid = $row['EventID'];
                  $res2 = mysqli_query($conn, "SELECT reason FROM approval_history 
                                             WHERE item_type='event' AND item_id=$eid 
                                             ORDER BY created_at DESC LIMIT 1");
                  if ($reasonRow = mysqli_fetch_assoc($res2)) {
                    echo "<br><small>เหตุผล: " . htmlspecialchars($reasonRow['reason']) . "</small>";
                  }
                  ?>
                <?php endif; ?>
              </td>
              <td>
                <a href="edit_event.php?id=<?= $row['EventID'] ?>" class="btn btn-warning btn-sm">✏️ แก้ไข</a>
                <a href="delete_event.php?id=<?= $row['EventID'] ?>"
                  class="btn btn-danger btn-sm"
                  onclick="return confirm('⚠️ คุณแน่ใจหรือไม่ที่จะลบอีเว้นท์นี้?')">
                  🗑️ ลบ
                </a>
              </td>

            <?php } ?>
        </tbody>
      </table>
    </div>
  </div>
</body>

</html>