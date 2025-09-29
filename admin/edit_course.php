<?php
include __DIR__ . '/auth.php';
include __DIR__ . '/../db_connect.php';

$id = intval($_GET['id']);
$error = "";
$success = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $name = mysqli_real_escape_string($conn, $_POST['CourseName']);
  $category = mysqli_real_escape_string($conn, $_POST['Category']);
  $description = mysqli_real_escape_string($conn, $_POST['Description']);
  $duration = mysqli_real_escape_string($conn, $_POST['Duration']);
  $fee = floatval($_POST['Fee']);
  $teacher = mysqli_real_escape_string($conn, $_POST['Teacher']);

  $image = $_POST['old_image'];
  if (!empty($_FILES['Image']['name'])) {
    $targetDir = __DIR__ . "/../uploads/";
    $fileName = time() . "_" . basename($_FILES['Image']['name']);
    $targetFile = $targetDir . $fileName;

    if (move_uploaded_file($_FILES['Image']['tmp_name'], $targetFile)) {
      $image = $fileName;
    }
  }

  $sql = "UPDATE course 
          SET CourseName='$name', Category='$category', Description='$description',
              Duration='$duration', Fee='$fee', Teacher='$teacher', Image='$image',
              status='pending'
          WHERE CourseID=$id";

  if (mysqli_query($conn, $sql)) {
    $success = "✅ แก้ไขคอร์สสำเร็จ (รอ Owner อนุมัติ)";

    // ✅ Insert ลง approval_history
    $cid = $id;
    mysqli_query($conn, "
        INSERT INTO approval_history (item_type, item_id, status, reason, created_at)
        VALUES ('course', $cid, 'pending', '', NOW())
    ");
  } else {
    $error = "❌ เกิดข้อผิดพลาด: " . mysqli_error($conn);
  }
}


$result = mysqli_query($conn, "SELECT * FROM course WHERE CourseID=$id");
$course = mysqli_fetch_assoc($result);
?>
<!DOCTYPE html>
<html lang="th">

<head>
  <meta charset="UTF-8">
  <title>แก้ไขคอร์ส</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="public/admin_course_edit.css">
</head>

<body>
  <div class="container py-5">
    <h1>✏️ แก้ไขคอร์ส</h1>

    <?php if ($error) echo "<div class='alert alert-danger'>$error</div>"; ?>
    <?php if ($success) echo "<div class='alert alert-success'>$success</div>"; ?>

    <form method="post" enctype="multipart/form-data">
      <div class="mb-3">
        <label>ชื่อคอร์ส</label>
        <input type="text" name="CourseName" class="form-control" value="<?= htmlspecialchars($course['CourseName']) ?>" required>
      </div>
      <div class="mb-3">
        <label>หมวดหมู่</label>
        <input type="text" name="Category" class="form-control" value="<?= htmlspecialchars($course['Category']) ?>" required>
      </div>
      <div class="mb-3">
        <label>รายละเอียด</label>
        <textarea name="Description" class="form-control" required><?= htmlspecialchars($course['Description']) ?></textarea>
      </div>
      <div class="mb-3">
        <label>ระยะเวลา</label>
        <input type="text" name="Duration" class="form-control" value="<?= htmlspecialchars($course['Duration']) ?>" required>
      </div>
      <div class="mb-3">
        <label>ราคา</label>
        <input type="number" name="Fee" class="form-control" step="0.01" value="<?= htmlspecialchars($course['Fee']) ?>" required>
      </div>
      <div class="mb-3">
        <label>ครูผู้สอน</label>
        <input type="text" name="Teacher" class="form-control" value="<?= htmlspecialchars($course['Teacher']) ?>" required>
      </div>
      <div class="mb-3">
        <label>รูปภาพ</label><br>
        <?php if ($course['Image']) { ?>
          <img src="../uploads/<?= $course['Image'] ?>" width="120" class="mb-2"><br>
        <?php } ?>
        <input type="hidden" name="old_image" value="<?= $course['Image'] ?>">
        <input type="file" name="Image" class="form-control" accept="image/*">
      </div>
      <button type="submit" class="btn btn-success">บันทึก</button>
      <a href="manage_COURSE.php" class="btn btn-secondary">⬅ กลับไปจัดการคอร์ส</a>
    </form>
  </div>
</body>

</html>