<?php
session_start();
include 'db_connect.php';

if (!isset($_SESSION['A_Username'])) {
    header("Location: login.php");
    exit();
}

// ดึงข้อมูลแอดมิน
$result_admin = mysqli_query($conn, "SELECT A_ID as ID, A_Username as Username, A_Name as Name, A_Role as Role, A_Phone as Phone, 'Admin' as UserType FROM admin");

// ดึงข้อมูลผู้บริหาร
$result_owner = mysqli_query($conn, "SELECT OwnerID as ID, O_Username as Username, O_Name as Name, O_Position as Role, NULL as Phone, 'Owner' as UserType FROM owner");

// รวมผลลัพธ์
$users = [];
while($row = mysqli_fetch_assoc($result_admin)) { $users[] = $row; }
while($row = mysqli_fetch_assoc($result_owner)) { $users[] = $row; }

?>
<!DOCTYPE html>
<html lang="th">
<head>
<meta charset="UTF-8">
<title>จัดการผู้ใช้ระบบ</title>
<link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Prompt:wght@400;500;600;700&display=swap" rel="stylesheet">
<style>
body { 
    background:#0b0b0b; 
    color:#e0e0e0; 
    font-family:'Prompt',sans-serif; 

    /* 👇 จัดกึ่งกลางจอ */
    display:flex;
    justify-content:center;
    align-items:center;
    min-height:100vh;
    margin:0;
}
.container { max-width:1100px; }
h1 { text-align:center; margin-bottom:30px; font-weight:700; color:#fff; }
.card-container { background:#111; border-radius:20px; padding:30px 30px 80px 30px; box-shadow:0 8px 25px rgba(0,0,0,0.6); position:relative; }
table { width:100%; background:#1a1a1a; border-radius:15px; overflow:hidden; box-shadow:0 5px 20px rgba(0,0,0,0.4); }
th, td { padding:14px 16px; text-align:center; vertical-align:middle; border:1px solid #2c2c2c; }
th { background:#ff5733; color:#fff; font-weight:600; }
tr:hover { background: rgba(255,255,255,0.05); }
a.btn { text-decoration:none; border-radius:25px; font-weight:500; transition:0.3s; padding:8px 18px; }
a.btn-success { background: linear-gradient(45deg,#ff7043,#ff5733); color:#fff; border:none; margin-bottom:25px; display:inline-block; }
a.btn-success:hover { transform:translateY(-2px) scale(1.03); box-shadow:0 4px 15px rgba(255,87,51,0.4); }
a.btn-warning { background:#ffb74d; color:#111; border:none; }
a.btn-danger { background:#ff3d3d; color:#fff; border:none; }
a.btn-secondary { background:#333; color:#fff; border:none; text-decoration:none; }
.btn-bottom-right { position:absolute; bottom:20px; right:20px; }
</style>
</head>
<body>
<div class="container">
  <div class="card-container">
    <h1>จัดการผู้ใช้ระบบ</h1>

    <!-- ปุ่มเพิ่มผู้ใช้ใหม่ -->
    <a href="add_users.php" class="btn btn-success">เพิ่มผู้ใช้ใหม่</a>

    <table class="table table-dark text-center align-middle">
      <thead>
        <tr>
          <th>ID</th>
          <th>Username</th>
          <th>ชื่อ</th>
          <th>ตำแหน่ง / Role</th>
          <th>เบอร์โทร</th>
          <th>ประเภทผู้ใช้</th>
          <th>จัดการ</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach($users as $u): ?>
        <tr>
          <td><?= $u['ID'] ?></td>
          <td><?= htmlspecialchars($u['Username']) ?></td>
          <td><?= htmlspecialchars($u['Name']) ?></td>
          <td><?= htmlspecialchars($u['Role']) ?></td>
          <td><?= $u['Phone'] ?? '-' ?></td>
          <td><?= $u['UserType'] ?></td>
          <td>
            <a href="edit_users.php?id=<?= $u['ID'] ?>&type=<?= $u['UserType'] ?>" class="btn btn-warning btn-sm">✏️ แก้ไข</a>
            <a href="delete_users.php?id=<?= $u['ID'] ?>&type=<?= $u['UserType'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('แน่ใจว่าจะลบผู้ใช้นี้?');">🗑️ ลบ</a>
          </td>
        </tr>
        <?php endforeach; ?>
      </tbody>
    </table>

    <!-- ปุ่มกลับแดชบอร์ด ขวาล่าง -->
    <a href="admin_dashboard.php" class="btn btn-secondary btn-bottom-right">กลับแดชบอร์ด</a>
  </div>
</div>
</body>
</html>
