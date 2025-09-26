<?php
session_start();
include __DIR__ . '/db_connect.php';

if (!isset($_SESSION['O_Username'])) {
  header("Location: login.php");
  exit();
}

$result = mysqli_query($conn, "SELECT * FROM event WHERE status='pending' ORDER BY E_StartDate ASC");
?>
<!DOCTYPE html>
<html lang="th">

<head>
  <meta charset="UTF-8">
  <title>ตรวจสอบ Event (Pending)</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    :root {
      --bg: #000;
      --panel: #101010;
      --panel-2: #161616;
      --text: #ffa726;
      --muted: #d68a1e;
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
      max-width: 1150px;
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

    .badge {
      font-size: .85rem
    }

    .badge-pending {
      background: #ffe082;
      color: #000
    }

    .card-like {
      background: var(--panel-2);
      border: 1px solid var(--line);
      border-radius: 14px;
      padding: 18px;
      margin-bottom: 18px
    }

    img.thumb {
      width: 100px;
      height: 70px;
      object-fit: cover;
      border-radius: 6px;
      border: 1px solid var(--line)
    }

    a,
    a:visited {
      color: #fff
    }
  </style>
</head>

<body>
  <div class="container">
    <div class="card-like">
      <h1>📅 ตรวจสอบ Event (Pending)</h1>
      <a href="owner_dashboard.php" class="btn btn-back btn-sm mb-3">⬅ กลับ Dashboard</a>

      <table class="table table-bordered align-middle">
        <thead>
          <tr>
            <th>ID</th>
            <th>ภาพ</th>
            <th>ชื่อ Event</th>
            <th>รายละเอียด</th>
            <th>วันที่เริ่ม</th>
            <th>วันที่สิ้นสุด</th>
            <th>สถานที่</th>
            <th>สถานะ</th>
            <th>การจัดการ</th>
          </tr>
        </thead>
        <tbody>
          <?php while ($row = mysqli_fetch_assoc($result)) { ?>
            <tr>
              <td><?= $row['EventID'] ?></td>
              <td>
                <?php if (!empty($row['E_Image'])): ?>
                  <img class="thumb" src="../uploads/<?= htmlspecialchars($row['E_Image']) ?>">
                <?php else: ?>
                  <img class="thumb" src="../image/no-image.png">
                <?php endif; ?>
              </td>
              <td><?= htmlspecialchars($row['E_Title']) ?></td>
              <td style="max-width:260px; text-align:left"><?= nl2br(htmlspecialchars($row['E_Detail'])) ?></td>
              <td><?= $row['E_StartDate'] ?></td>
              <td><?= $row['E_EndDate'] ?></td>
              <td><?= htmlspecialchars($row['E_Location']) ?></td>
              <td><span class="badge badge-pending">⏳ <?= ucfirst($row['status']) ?></span></td>
              <td>
                <a href="approve.php?type=event&id=<?= $row['EventID'] ?>&action=approve" class="btn btn-success btn-sm">✅ Approve</a>
                <a href="approve.php?type=event&id=<?= $row['EventID'] ?>&action=disapprove" class="btn btn-danger btn-sm">❌ Disapprove</a>
              </td>
            </tr>
          <?php } ?>
        </tbody>
      </table>
    </div>
  </div>
</body>

</html>