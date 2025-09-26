<?php
include __DIR__ . '/auth.php';
?>
<!DOCTYPE html>
<html lang="th">
<head>
  <meta charset="UTF-8">
  <title>Owner Dashboard</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body { background:#000; color:#fff; font-family:'Prompt', sans-serif; }
    .container { max-width:900px; margin:60px auto; text-align:center; }
    h1 { color:#ff5733; margin-bottom:20px; }
    .menu { display:grid; grid-template-columns:repeat(auto-fit,minmax(220px,1fr)); gap:20px; margin-top:30px; }
    .card { background:#111; border:none; border-radius:15px; padding:30px; transition:.3s; box-shadow:0 4px 15px rgba(255,255,255,.1); }
    .card:hover { background:#1e1e1e; transform:translateY(-5px); }
    .card a { text-decoration:none; color:#fff; font-weight:600; }
    .logout { display:inline-block; margin-top:40px; padding:12px 25px; background:#ff5733; border-radius:25px; color:#fff; font-weight:600; text-decoration:none; transition:.3s; }
    .logout:hover { background:#c70039; }
  </style>
</head>
<body>
  <div class="container">
    <h1>📊 Owner Dashboard</h1>
    <p>ยินดีต้อนรับ <strong><?php echo $_SESSION['O_Username']; ?></strong> 👋</p>

    <div class="menu">
      <div class="card"><a href="owner_review_event.php">📅 ตรวจสอบ Event</a></div>
      <div class="card"><a href="owner_review_course.php">📘 ตรวจสอบ Course</a></div>
      <div class="card"><a href="history.php">📜 ดูประวัติ</a></div>
    </div>

    <a href="logout.php" class="logout">🚪 ออกจากระบบ</a>
  </div>
</body>
</html>
