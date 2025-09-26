<?php
session_start();
include __DIR__ . '/db_connect.php';

if (!isset($_SESSION['O_Username'])) {
  header("Location: login.php");
  exit();
}

$result = mysqli_query($conn, "SELECT * FROM history ORDER BY created_at DESC");
?>
<!DOCTYPE html>
<html lang="th">

<head>
  <meta charset="UTF-8">
  <title>ประวัติการอนุมัติ</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    :root {
      --bg: #000;
      --panel: #101010;
      --panel-2: #161616;
      --text: #ffa726;
      --line: #2a2a2a;
    }

    * {
      font-family: 'Prompt', sans-serif
    }

    body {
      background: var(--bg);
      color: var(--text)
    }

    .container {
      max-width: 1100px;
      margin: auto;
      padding: 28px
    }

    h1,
    h2,
    h3,
    h4,
    h5,
    h6 {
      color: #ff7043  !important;
      /* 🎨 สีส้มสด統一 */
      font-weight: bold;
    }

    .text-warning {
      color: #ff7043  !important;
      /* override bootstrap */
    }

    .btn-back {
      background: #6c757d;
      color: #fff;
      border: 0
    }

    .btn-back:hover {
      background: #444
    }

    table {
      background: var(--panel);
      border-radius: 12px;
      overflow: hidden;
      border-color: var(--line)
    }

    thead th {
      background: var(--panel-2);
      color: var(--text);
      border-color: var(--line);
      text-align: center
    }

    tbody td {
      border-color: var(--line);
      color: #f0f0f0;
      text-align: center;
      vertical-align: middle
    }

    .badge-ok {
      background: #66bb6a
    }

    .badge-no {
      background: #ef5350
    }
  </style>
</head>

<body>
  <div class="container">
    <h1>📜 ประวัติการอนุมัติ / ไม่อนุมัติ</h1>
    <a href="owner_dashboard.php" class="btn btn-back btn-sm mb-3">⬅ กลับ Dashboard</a>

    <table class="table table-bordered align-middle">
      <thead>
        <tr>
          <th>เวลา</th>
          <th>ประเภท</th>
          <th>ไอเท็ม ID</th>
          <th>ผลการพิจารณา</th>
          <th>เหตุผล</th>
          <th>โดย</th>
        </tr>
      </thead>
      <tbody>
        <?php while ($row = mysqli_fetch_assoc($result)) { ?>
          <tr>
            <td><?= $row['created_at'] ?></td>
            <td><?= $row['item_type'] == 'course' ? 'คอร์ส' : 'อีเวนท์' ?></td>
            <td><?= $row['item_id'] ?></td>
            <td>
              <?php if ($row['action'] == 'approved'): ?>
                <span class="badge badge-ok">✅ Approved</span>
              <?php else: ?>
                <span class="badge badge-no">❌ Disapproved</span>
              <?php endif; ?>
            </td>
            <td style="max-width:320px; text-align:left"><?= nl2br(htmlspecialchars($row['reason'] ?: '-')) ?></td>
            <td><?= htmlspecialchars($row['owner']) ?></td>
          </tr>
        <?php } ?>
      </tbody>
    </table>
  </div>
</body>

</html>