<?php
include __DIR__ . '/auth.php'; // ✅ ต้อง login ก่อนถึงเข้าได้
?>
<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard - YJ Creating</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="public/style.css">
    <style>
        body { background:#000; color:#fff; }
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
        <h1>📊 แดชบอร์ดผู้ดูแลระบบ</h1>
        <p>สวัสดีคุณ <strong><?php echo $_SESSION['A_Username']; ?></strong> 👋</p>

        <div class="menu">
            <div class="card"><a href="manage_HOME.php">🏠 จัดการ HOME</a></div>
            <div class="card"><a href="manage_COURSE.php">📘 จัดการ COURSE</a></div>
            <div class="card"><a href="admin_history.php">📜 ประวัติการแก้ไข</a></div>
        </div>

        <a href="logout.php" class="logout">🚪 ออกจากระบบ</a>
    </div>
</body>
</html>
