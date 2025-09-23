<?php
session_start();
include '../db_connect.php';

// ดึงข้อมูลคอร์สทั้งหมด
$result = mysqli_query($conn, "SELECT * FROM course");
?>
<!DOCTYPE html>
<html lang="th">
<head>
  <meta charset="UTF-8">
  <title>จัดการคอร์ส</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body { background:#0b0b0b; color:#fff; font-family:'Prompt', sans-serif; }
    .container { margin-top: 60px; background:#111; padding:30px; border-radius:15px; box-shadow:0 8px 20px rgba(0,0,0,0.6); }
    h2 { text-align:center; margin-bottom:20px; color:#ff5722; }
    .btn-add { margin-bottom:15px; background:#ff5722; border:none; color:#fff; border-radius:25px; padding:8px 20px; transition:0.3s; }
    .btn-add:hover { background:#ff784e; }
    table { background:#1c1c1c; border-radius:10px; overflow:hidden; }
    th { background:#ff5722; color:#fff; text-align:center; }
    td { text-align:center; vertical-align:middle; }
    img.course-img { width:100px; border-radius:10px; }
  </style>
</head>
<body>
  <div class="container">
    <h2>📚 จัดการคอร์ส</h2>
    <a href="add_course.php" class="btn btn-add">➕ เพิ่มคอร์สใหม่</a>

    <table class="table table-dark table-hover align-middle">
      <thead>
        <tr>
          <th>ID</th>
          <th>ชื่อคอร์ส</th>
          <th>หมวดหมู่</th>
          <th>คำอธิบาย</th>
          <th>ระยะเวลา</th>
          <th>ค่าใช้จ่าย</th>
          <th>ครูผู้สอน</th>
          <th>รูปภาพ</th>
          <th>การจัดการ</th>
        </tr>
      </thead>
      <tbody>
        <?php while ($row = mysqli_fetch_assoc($result)) { ?>
          <tr>
            <td><?= $row['CourseID'] ?></td>
            <td><?= $row['CourseName'] ?></td>
            <td><?= $row['Category'] ?></td>
            <td><?= $row['Description'] ?></td>
            <td><?= $row['Duration'] ?></td>
            <td><?= $row['Fee'] ?> บาท</td>
            <td><?= $row['Teacher'] ?></td>
            <td><img src="../uploads/<?= $row['Image'] ?>" class="course-img"></td>
            <td>
              <a href="edit_course.php?id=<?= $row['CourseID'] ?>" class="btn btn-warning btn-sm">✏️ แก้ไข</a>
              <a href="delete_course.php?id=<?= $row['CourseID'] ?>" 
                 onclick="return confirm('คุณแน่ใจว่าต้องการลบคอร์สนี้?');" 
                 class="btn btn-danger btn-sm">🗑️ ลบ</a>
            </td>
          </tr>
        <?php } ?>
      </tbody>
    </table>
  </div>
  <div class="text-center mt-4">
    <a href="admin_dashboard.php" class="btn btn-secondary btn-lg">⬅ กลับแดชบอร์ด</a>
  </div>
</body>
</html>
