<?php
session_start();
include 'db_connect.php';

if (!isset($_SESSION['A_Username'])) {
    header("Location: login.php");
    exit();
}

$result = mysqli_query($conn, "SELECT * FROM news ORDER BY N_Date DESC");
?>
<!DOCTYPE html>
<html lang="th">
<head>
<meta charset="UTF-8">
<title>จัดการข่าวสาร - YJ Creating</title>
<link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Prompt:wght@300;400;500;600;700&family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
<style>
body {
    background: #0b0b0b;
    color: #e0e0e0;
    font-family: 'Prompt', 'Poppins', sans-serif;

    /* 👇 จัดกึ่งกลางจอ */
    display: flex;
    justify-content: center;
    align-items: center;
    min-height: 100vh;
    margin: 0;
}
h1 {
    color: #fff;
    font-weight: 700;
    text-align: center;
    margin-bottom: 30px;
}
.card-container {
    background: #111;
    border-radius: 20px;
    padding: 30px;
    padding-bottom: 80px;
    box-shadow: 0 8px 25px rgba(0,0,0,0.6);
    position: relative;
}
.btn-add-news {
    display: inline-block;
    margin-bottom: 25px;
    text-decoration: none;
}
a.btn {
    border-radius: 25px;
    font-weight: 500;
    transition: 0.3s;
    padding: 8px 18px;
    text-decoration: none;
}
a.btn-success {
    background: linear-gradient(45deg,#ff7043,#ff5733);
    border: none;
    color: #fff;
}
a.btn-success:hover {
    transform: translateY(-2px) scale(1.03);
    box-shadow: 0 4px 15px rgba(255,87,51,0.4);
}
a.btn-warning { background: #ffb74d; border: none; color: #111; }
a.btn-danger { background: #ff3d3d; border: none; color: #fff; }
a.btn-secondary { background: #333; border: none; color: #fff; text-decoration: none; }
.btn-bottom-right {
    position: absolute;
    bottom: 20px;
    right: 20px;
}
table {
    background: #1a1a1a;
    border-radius: 15px;
    overflow: hidden;
    box-shadow: 0 5px 20px rgba(0,0,0,0.4);
    width: 100%;
}
th, td {
    padding: 14px 16px;
    text-align: center;
    vertical-align: middle;
    border: 1px solid #2c2c2c;
}
th { background: #ff5733; color: #fff; font-weight: 600; }
tr:hover { background: rgba(255,255,255,0.05); }
.container { max-width: 1100px; }
</style>
</head>
<body>
<div class="container">
    <div class="card-container">
        <h1>จัดการข่าวสาร</h1>

        <!-- ปุ่มเพิ่มข่าวสาร -->
        <a href="add_news.php" class="btn btn-success btn-add-news">เพิ่มข่าวสารใหม่</a>

        <table class="table table-dark text-center align-middle">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>หัวข้อข่าว</th>
                    <th>รายละเอียด</th>
                    <th>วันที่</th>
                    <th>การจัดการ</th>
                </tr>
            </thead>
            <tbody>
                <?php while($row = mysqli_fetch_assoc($result)) { ?>
                <tr>
                    <td><?= $row['NewsID'] ?></td>
                    <td><?= htmlspecialchars($row['N_Title']) ?></td>
                    <td><?= htmlspecialchars($row['N_Detail']) ?></td>
                    <td><?= $row['N_Date'] ?></td>
                    <td>
                        <a href="edit_news.php?id=<?= $row['NewsID'] ?>" class="btn btn-warning btn-sm">✏️ แก้ไข</a>
                        <a href="delete_news.php?id=<?= $row['NewsID'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('แน่ใจว่าจะลบข่าวสารนี้?');">🗑️ ลบ</a>
                    </td>
                </tr>
                <?php } ?>
            </tbody>
        </table>

        <!-- ปุ่มกลับแดชบอร์ด ขวาล่าง -->
        <a href="admin_dashboard.php" class="btn btn-secondary btn-bottom-right">กลับแดชบอร์ด</a>
    </div>
</div>
</body>
</html>
