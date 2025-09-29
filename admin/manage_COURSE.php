<?php
include __DIR__ . '/auth.php';
include __DIR__ . '/../db_connect.php';

$error = "";
$success = "";

// ✅ ADD Course
if (isset($_POST['add'])) {
  $name     = mysqli_real_escape_string($conn, $_POST['CourseName']);
  $category = mysqli_real_escape_string($conn, $_POST['Category']);
  $desc     = mysqli_real_escape_string($conn, $_POST['Description']);
  $duration = mysqli_real_escape_string($conn, $_POST['Duration']);
  $fee      = floatval($_POST['Fee']);
  $teacher  = mysqli_real_escape_string($conn, $_POST['Teacher']);

  $image = null;
  if (!empty($_FILES['Image']['name'])) {
    $targetDir = __DIR__ . "/../uploads/";
    if (!is_dir($targetDir)) mkdir($targetDir, 0777, true);

    $fileName = time() . "_" . basename($_FILES['Image']['name']);
    $targetFile = $targetDir . $fileName;

    if (move_uploaded_file($_FILES['Image']['tmp_name'], $targetFile)) {
      $image = $fileName;
    } else {
      $error = "❌ Upload ล้มเหลว";
    }
  }

  if ($name && $category && $desc && $duration && $fee && $teacher) {
    $sql = "INSERT INTO course (CourseName, Category, Description, Duration, Fee, Teacher, Image, status) 
            VALUES ('$name','$category','$desc','$duration','$fee','$teacher','$image','pending')";
    if (mysqli_query($conn, $sql)) {
      $success = "✅ เพิ่มคอร์สสำเร็จ (รอ Owner อนุมัติ)";
    } else {
      $error = "❌ เกิดข้อผิดพลาด: " . mysqli_error($conn);
    }
  }
}

$result = mysqli_query($conn, "SELECT * FROM course ORDER BY CourseID DESC");
?>
<!DOCTYPE html>
<html lang="th">

<head>
  <meta charset="UTF-8">
  <title>จัดการคอร์ส</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="public/admin_course.css">
</head>

<body>
  <div class="container">
    <h1>📘 จัดการคอร์ส</h1>
    <a href="admin_dashboard.php" class="btn btn-back mb-3">⬅ กลับแดชบอร์ด</a>

    <!-- Add Course -->
    <div class="card">
      <h4>➕ เพิ่มคอร์สใหม่</h4>
      <?php if ($error) echo "<div class='alert alert-danger'>$error</div>"; ?>
      <?php if ($success) echo "<div class='alert alert-success'>$success</div>"; ?>
      <form method="post" enctype="multipart/form-data">
        <label>ชื่อคอร์ส</label>
        <input type="text" name="CourseName" class="form-control" required>
        <label>หมวดหมู่</label>
        <input type="text" name="Category" class="form-control" required>
        <label>รายละเอียด</label>
        <textarea name="Description" class="form-control" required></textarea>
        <div class="row">
          <div class="col-md-6">
            <label>ระยะเวลา</label>
            <input type="text" name="Duration" class="form-control" required>
          </div>
          <div class="col-md-6">
            <label>ราคา</label>
            <input type="number" step="0.01" name="Fee" class="form-control" required>
          </div>
        </div>
        <label>ครูผู้สอน</label>
        <input type="text" name="Teacher" class="form-control" required>
        <label>รูปภาพ</label>
        <input type="file" name="Image" class="form-control" accept="image/*">
        <button type="submit" name="add" class="btn btn-success mt-3">บันทึก</button>
      </form>
    </div>

    <!-- Course List -->
    <div class="card">
      <h4>📋 รายการคอร์ส</h4>
      <table class="table table-dark table-bordered align-middle">
        <thead>
          <tr>
            <th>ID</th>
            <th>ชื่อ</th>
            <th>ครูผู้สอน</th>
            <th>ราคา</th>
            <th>สถานะ</th>
            <th>การจัดการ</th>
          </tr>
        </thead>
        <tbody>
          <?php while ($row = mysqli_fetch_assoc($result)) { ?>
            <tr>
              <td><?= $row['CourseID'] ?></td>
              <td><?= htmlspecialchars($row['CourseName']) ?></td>
              <td><?= htmlspecialchars($row['Teacher']) ?></td>
              <td><?= number_format($row['Fee'], 2) ?></td>
              <td>
                <?php if ($row['status'] == 'approved'): ?>
                  <span class="badge bg-success">✅ Approved</span>
                <?php elseif ($row['status'] == 'pending'): ?>
                  <span class="badge bg-warning text-dark">⏳ Pending</span>
                <?php else: ?>
                  <span class="badge bg-danger">❌ Disapproved</span>
                  <?php
                  $cid = $row['CourseID'];
                  $res2 = mysqli_query($conn, "SELECT reason FROM approval_history 
                                             WHERE item_type='course' AND item_id=$cid 
                                             ORDER BY created_at DESC LIMIT 1");
                  if ($reasonRow = mysqli_fetch_assoc($res2)) {
                    echo "<br><small>เหตุผล: " . htmlspecialchars($reasonRow['reason']) . "</small>";
                  }
                  ?>
                <?php endif; ?>
              </td>
              <td>
                <a href="edit_course.php?id=<?= $row['CourseID'] ?>" class="btn btn-warning btn-sm">✏️ แก้ไข</a>
                <a href="delete_course.php?id=<?= $row['CourseID'] ?>"
                  class="btn btn-danger btn-sm"
                  onclick="return confirm('คุณแน่ใจหรือไม่ที่จะลบคอร์สนี้?')">🗑 ลบ</a>
              </td>

            </tr>
          <?php } ?>
        </tbody>
      </table>
    </div>
  </div>
</body>

</html>