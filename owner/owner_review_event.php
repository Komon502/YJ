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
  <link href="https://fonts.googleapis.com/css2?family=Prompt:wght@300;400;500;600;700&display=swap" rel="stylesheet">
  <style>
    :root {
      --bg-main: #0a0a0a;
      --bg-gradient: linear-gradient(135deg, #0a0a0a 0%, #1a0505 100%);
      --card-bg: #1c1c1c;
      --card-border: #2d2d2d;
      --accent-red: #ef4444;
      --accent-red-dark: #dc2626;
      --text-primary: #f5f5f5;
      --text-secondary: #d1d5db;
      --text-muted: #9ca3af;
      --success: #10b981;
      --warning: #f59e0b;
    }

    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    body {
      background: var(--bg-gradient);
      color: var(--text-primary);
      font-family: 'Prompt', sans-serif;
      min-height: 100vh;
      padding: 30px 20px;
      font-size: 15px;
    }

    .container {
      max-width: 1500px;
      margin: 0 auto;
    }

    .header-section {
      background: var(--card-bg);
      border: 1px solid var(--card-border);
      border-radius: 16px;
      padding: 32px 36px;
      margin-bottom: 28px;
      box-shadow: 0 8px 32px rgba(0, 0, 0, 0.4);
      position: relative;
      overflow: hidden;
    }

    .header-section::before {
      content: '';
      position: absolute;
      top: 0;
      left: 0;
      right: 0;
      height: 4px;
      background: linear-gradient(90deg, var(--accent-red) 0%, var(--accent-red-dark) 100%);
    }

    h1 {
      color: var(--text-primary);
      font-weight: 700;
      font-size: 2.2rem;
      margin-bottom: 22px;
      display: flex;
      align-items: center;
      gap: 16px;
      letter-spacing: -0.5px;
    }

    h1::before {
      content: '📅';
      font-size: 2.8rem;
      filter: drop-shadow(0 0 8px rgba(239, 68, 68, 0.3));
    }

    .btn-back {
      background: linear-gradient(135deg, #3f3f46 0%, #27272a 100%);
      color: var(--text-primary);
      border: 1px solid var(--card-border);
      padding: 11px 26px;
      border-radius: 10px;
      font-weight: 600;
      font-size: 15px;
      transition: all 0.3s ease;
      display: inline-flex;
      align-items: center;
      gap: 10px;
      text-decoration: none;
    }

    .btn-back:hover {
      background: linear-gradient(135deg, #52525b 0%, #3f3f46 100%);
      transform: translateY(-2px);
      box-shadow: 0 6px 20px rgba(239, 68, 68, 0.25);
      color: var(--text-primary);
    }

    .table-container {
      background: var(--card-bg);
      border-radius: 16px;
      overflow: hidden;
      border: 1px solid var(--card-border);
      box-shadow: 0 8px 32px rgba(0, 0, 0, 0.4);
    }

    table {
      margin: 0;
      width: 100%;
      font-size: 15px;
    }

    thead th {
      background: linear-gradient(135deg, #262626 0%, #1a0505 100%);
      color: #ffffff !important;
      border: none;
      border-bottom: 2px solid var(--accent-red);
      text-align: center;
      padding: 20px 14px;
      font-weight: 700;
      font-size: 14px;
      text-transform: uppercase;
      letter-spacing: 0.8px;
    }

    table:not(caption)>* {
      color: #ffffff;
    }

    tbody td {
      background: var(--card-bg);
      border: none;
      border-bottom: 1px solid var(--card-border);
      color: var(--text-secondary);
      text-align: center;
      vertical-align: middle;
      padding: 18px 14px;
      font-size: 15px;
      font-weight: 500;
      transition: all 0.2s ease;
    }

    tbody tr {
      transition: all 0.2s ease;
    }

    tbody tr:hover {
      background: #232323;
    }

    tbody tr:hover td {
      background: #232323;
      color: var(--text-primary);
    }

    tbody tr:last-child td {
      border-bottom: none;
    }

    .badge {
      font-size: 14px;
      padding: 8px 16px;
      border-radius: 10px;
      font-weight: 700;
      display: inline-flex;
      align-items: center;
      gap: 8px;
      box-shadow: 0 4px 12px rgba(0, 0, 0, 0.3);
    }

    .badge-pending {
      background: linear-gradient(135deg, var(--warning) 0%, #ea580c 100%);
      color: #000;
    }

    img.thumb {
      width: 120px;
      height: 85px;
      object-fit: cover;
      border-radius: 12px;
      border: 2px solid var(--card-border);
      transition: all 0.3s ease;
      box-shadow: 0 4px 12px rgba(0, 0, 0, 0.5);
    }

    img.thumb:hover {
      transform: scale(1.12);
      border-color: var(--accent-red);
      box-shadow: 0 6px 24px rgba(239, 68, 68, 0.4);
    }

    .btn-success {
      background: linear-gradient(135deg, var(--success) 0%, #059669 100%);
      border: none;
      color: #fff;
      padding: 9px 18px;
      border-radius: 10px;
      font-weight: 700;
      font-size: 14px;
      transition: all 0.3s ease;
      box-shadow: 0 4px 12px rgba(16, 185, 129, 0.3);
      text-decoration: none;
      display: inline-block;
    }

    .btn-success:hover {
      background: linear-gradient(135deg, #34d399 0%, #10b981 100%);
      transform: translateY(-2px);
      box-shadow: 0 6px 18px rgba(16, 185, 129, 0.5);
      color: #fff;
    }

    .btn-danger {
      background: linear-gradient(135deg, var(--accent-red) 0%, var(--accent-red-dark) 100%);
      border: none;
      color: #fff;
      padding: 9px 18px;
      border-radius: 10px;
      font-weight: 700;
      font-size: 14px;
      transition: all 0.3s ease;
      box-shadow: 0 4px 12px rgba(239, 68, 68, 0.3);
      text-decoration: none;
      display: inline-block;
    }

    .btn-danger:hover {
      background: linear-gradient(135deg, #f87171 0%, #ef4444 100%);
      transform: translateY(-2px);
      box-shadow: 0 6px 18px rgba(239, 68, 68, 0.5);
      color: #fff;
    }

    .detail-text {
      text-align: left !important;
      color: var(--text-muted) !important;
      font-size: 14px !important;
      line-height: 1.6 !important;
      max-width: 300px;
      font-weight: 400 !important;
    }

    .title-text {
      color: var(--text-primary);
      font-weight: 600;
      font-size: 15px;
    }

    .id-text {
      color: var(--accent-red);
      font-weight: 700;
      font-size: 16px;
    }

    @media (max-width: 768px) {
      .table-container {
        overflow-x: auto;
      }

      h1 {
        font-size: 1.6rem;
      }
    }
  </style>
</head>

<body>
  <div class="container">
    <div class="header-section">
      <h1>ตรวจสอบ Event (Pending)</h1>
      <a href="owner_dashboard.php" class="btn btn-back">
        <span>⬅</span> กลับ Dashboard
      </a>
    </div>

    <div class="table-container">
      <table class="table align-middle">
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
              <td class="id-text"><?= $row['EventID'] ?></td>
              <td>
                <?php if (!empty($row['E_Image'])): ?>
                  <img class="thumb" src="../uploads/<?= htmlspecialchars($row['E_Image']) ?>" alt="Event">
                <?php else: ?>
                  <img class="thumb" src="../image/no-image.png" alt="No Image">
                <?php endif; ?>
              </td>
              <td class="title-text"><?= htmlspecialchars($row['E_Title']) ?></td>
              <td class="detail-text"><?= nl2br(htmlspecialchars($row['E_Detail'])) ?></td>
              <td><?= $row['E_StartDate'] ?></td>
              <td><?= $row['E_EndDate'] ?></td>
              <td><?= htmlspecialchars($row['E_Location']) ?></td>
              <td><span class="badge badge-pending">⏳ <?= ucfirst($row['status']) ?></span></td>
              <td>
                <a href="approve.php?type=event&id=<?= $row['EventID'] ?>&action=approve" class="btn btn-success btn-sm mb-1">✅ Approve</a>
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