<?php
session_start();

// ถ้ายังไม่ได้ล็อกอิน → กลับไปหน้า login.php
if (!isset($_SESSION['A_Username'])) {
    header("Location: login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard - YJ Creating</title>
    <link href="https://fonts.googleapis.com/css2?family=Prompt:wght@200;400;600&display=swap" rel="stylesheet">
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <style>
        * { font-family: 'Prompt', sans-serif; }
        body { background:#000; color:#fff; margin:0; }
        .container { max-width:1000px; margin:50px auto; text-align:center; }
        h1 { color:#ff5733; margin-bottom:20px; }
        .welcome { font-size:1.2rem; margin-bottom:30px; color:#bbb; }
        .menu { display:grid; grid-template-columns:repeat(auto-fit,minmax(200px,1fr)); gap:20px; }
        .card { background:#111; border:none; border-radius:15px; padding:30px 20px; box-shadow:0 4px 15px rgba(255,255,255,0.1); transition:0.3s; }
        .card:hover { transform:translateY(-5px); background:#1c1c1c; }
        .card a { text-decoration:none; color:#fff; font-weight:bold; display:block; }
        .logout { margin-top:40px; display:inline-block; padding:12px 25px; background:#ff5733; border-radius:25px; color:#fff; text-decoration:none; font-weight:bold; transition:0.3s; }
        .logout:hover { background:#c70039; }
    </style>
</head>
<body>
    <div class="container">
        <h1>📊 แดชบอร์ดผู้ดูแลระบบ</h1>
        <p class="welcome">สวัสดีคุณ, <strong><?php echo $_SESSION['A_Username']; ?></strong> 👋</p>

        <div class="menu">
             <div class="card"><a href="manage_HOME.php">📅 จัดการ HOME</a></div>
             <div class="card"><a href="manage_ABOUT.php">📰 จัดการ ABOUT</a></div>   
            <div class="card"><a href="manage_COURSE.php">📘 จัดการ COURSE</a></div>
            <div class="card"><a href="manage_CONTACT.php">🖥️ จัดการ CONTACT</a></div>
            <div class="card"><a href="manage_users.php">👤 จัดการผู้ใช้ระบบ</a></div>  
        </div>

        <a href="logout.php" class="logout">🚪 ออกจากระบบ</a>
    </div>
<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>
