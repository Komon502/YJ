<?php
include __DIR__ . '/auth.php';
include __DIR__ . '/db_connect.php';

// ดึงข้อมูลจาก approval_history
$result = mysqli_query($conn, "
    SELECT h.*, 
           IF(h.item_type='course', c.CourseName, e.E_Title) AS item_name
    FROM approval_history h
    LEFT JOIN course c ON h.item_type='course' AND h.item_id=c.CourseID
    LEFT JOIN event e  ON h.item_type='event' AND h.item_id=e.EventID
    ORDER BY h.created_at DESC
");
?>
<!DOCTYPE html>
<html lang="th">

<head>
  <meta charset="UTF-8">
  <title>ประวัติการแก้ไข - Admin</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background: #000000ff;
      color: #f5f5f5;
      font-family: 'Prompt', sans-serif;
    }

    .container {
      max-width: 1100px;
      margin: auto;
      padding: 40px 15px;
    }

    h1 {
      color: #ff7043;
      text-align: center;
      margin-bottom: 25px;
      text-shadow: 0 0 12px rgba(255, 112, 67, .7);
    }

    table {
      background: #2b2a2aff;
      border-radius: 12px;
      overflow: hidden;
    }

    th {
      background: #ff7043;
      text-align: center;
    }

    td {
      text-align: center;
      vertical-align: middle;
    }

    .btn-back {
      background: #6c757d;
      border: none;
    }

    .btn-back:hover {
      background: #000000ff;
    }

    small {
      color: #ccc;
    }
  </style>
</head>

<body>
  <div class="container">
    <h1>📜 ประวัติการแก้ไข</h1>
    <a href="admin_dashboard.php" class="btn btn-back mb-3">⬅ กลับแดชบอร์ด</a>

    <table class="table table-dark table-bordered align-middle">
      <thead>
        <tr>
          <th>วันที่</th>
          <th>ประเภท</th>
          <th>ชื่อ</th>
          <th>สถานะ</th>
          <th>เหตุผล (ถ้ามี)</th>
        </tr>
      </thead>
      <tbody>
        <?php while ($row = mysqli_fetch_assoc($result)) { ?>
          <tr>
            <td><?= $row['created_at'] ?></td>
            <td><?= $row['item_type'] == 'course' ? '📘 คอร์ส' : '📅 อีเว้นท์' ?></td>
            <td><?= htmlspecialchars($row['item_name']) ?></td>
            <td>
              <?php if ($row['status'] == 'approved'): ?>
                <span class="badge bg-success">✅ Approved</span>
              <?php elseif ($row['status'] == 'pending'): ?>
                <span class="badge bg-warning text-dark">⏳ Pending</span>
              <?php else: ?>
                <span class="badge bg-danger">❌ Disapproved</span>
              <?php endif; ?>
            </td>
            <td><?= htmlspecialchars($row['reason'] ?: '-') ?></td>
          </tr>
        <?php } ?>
      </tbody>
    </table>
  </div>
</body>

</html>