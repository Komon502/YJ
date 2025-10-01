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
  <link href="https://fonts.googleapis.com/css2?family=Prompt:wght@300;400;500;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="style.css">
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
      --danger: #ef4444;
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
      max-width: 1400px;
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
      content: '📜';
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
      background: #1a1a1a;
      border-radius: 16px;
      overflow: hidden;
      border: 1px solid #333;
      box-shadow: 0 8px 32px rgba(0, 0, 0, 0.5);
    }

    table {
      margin: 0;
      width: 100%;
      font-size: 15px;
      border-collapse: collapse;
      /* ป้องกันช่องว่าง */
    }

    thead th {
      background: linear-gradient(135deg, #ff3b3b 0%, #b30000 100%);
      /* หัวตารางแดงสด */
      color: #fff !important;
      text-align: center;
      padding: 16px;
      font-weight: 700;
      font-size: 14px;
      text-transform: uppercase;
      letter-spacing: 1px;
    }

    tbody td {
      background-color: #1a1a1a !important;
      /* พื้นหลังดำเข้ม */
      color: #f5f5f5 !important;
      /* ตัวอักษรขาว */
      border-bottom: 1px solid #333;
      /* เส้นแบ่งเทาเข้ม */
      text-align: center;
      padding: 14px 16px;
    }

    tbody tr {
      transition: all 0.2s ease;
    }

    tbody tr:hover {
      background: #232323;
    }

    tbody tr:hover td {
      background-color: #2b2b2b !important;
      /* hover เทาอ่อนขึ้น */
      color: #fff !important;
    }

    tbody tr:last-child td {
      border-bottom: none;
    }

    .badge {
      font-size: 14px;
      padding: 8px 18px;
      border-radius: 10px;
      font-weight: 700;
      display: inline-flex;
      align-items: center;
      gap: 8px;
      text-transform: uppercase;
      letter-spacing: 0.8px;
      box-shadow: 0 4px 12px rgba(0, 0, 0, 0.3);
    }

    .badge-ok {
      background: linear-gradient(135deg, var(--success) 0%, #059669 100%);
      color: #fff;
    }

    .badge-no {
      background: linear-gradient(135deg, var(--danger) 0%, var(--accent-red-dark) 100%);
      color: #fff;
    }

    .type-badge {
      background: linear-gradient(135deg, #404040 0%, #262626 100%);
      color: var(--text-primary);
      padding: 6px 16px;
      border-radius: 8px;
      font-size: 14px;
      font-weight: 600;
      display: inline-flex;
      align-items: center;
      gap: 6px;
      box-shadow: 0 2px 8px rgba(0, 0, 0, 0.3);
    }

    .reason-text {
      text-align: left !important;
      color: var(--text-muted) !important;
      font-size: 14px !important;
      line-height: 1.6 !important;
      max-width: 380px;
      font-weight: 400 !important;
    }

    .time-text {
      color: var(--text-secondary);
      font-weight: 500;
      font-size: 14px;
    }

    .id-text {
      color: var(--accent-red);
      font-weight: 700;
      font-size: 16px;
    }

    .owner-text {
      color: var(--text-primary);
      font-weight: 600;
      font-size: 15px;
    }

    @media (max-width: 768px) {
      .table-container {
        overflow-x: auto;
      }

      h1 {
        font-size: 1.6rem;
      }

      body {
        font-size: 14px;
      }
    }
  </style>
</head>

<body>
  <div class="container">
    <div class="header-section">
      <h1>ประวัติการอนุมัติ / ไม่อนุมัติ</h1>
      <a href="owner_dashboard.php" class="btn btn-back">
        <span>⬅</span> กลับ Dashboard
      </a>
    </div>

    <div class="table-container">
      <table class="table align-middle">
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
              <td class="time-text"><?= $row['created_at'] ?></td>
              <td>
                <span class="type-badge">
                  <?= $row['item_type'] == 'course' ? '📘 คอร์ส' : '📅 อีเวนท์' ?>
                </span>
              </td>
              <td class="id-text"><?= $row['item_id'] ?></td>
              <td>
                <?php if ($row['action'] == 'approved'): ?>
                  <span class="badge badge-ok">✅ APPROVED</span>
                <?php else: ?>
                  <span class="badge badge-no">❌ DISAPPROVED</span>
                <?php endif; ?>
              </td>
              <td class="reason-text"><?= nl2br(htmlspecialchars($row['reason'] ?: '-')) ?></td>
              <td class="owner-text"><?= htmlspecialchars($row['owner']) ?></td>
            </tr>
          <?php } ?>
        </tbody>
      </table>
    </div>
  </div>
</body>

</html>