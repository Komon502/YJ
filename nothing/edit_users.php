<?php
session_start();
include 'db_connect.php';

// ตรวจสอบล็อกอิน
if (!isset($_SESSION['A_Username'])) {
    header("Location: login.php");
    exit();
}

if (!isset($_GET['id'])) {
    header("Location: manage_users.php");
    exit();
}

$id = intval($_GET['id']);
$result = mysqli_query($conn, "SELECT * FROM admin WHERE A_ID=$id");
$user = mysqli_fetch_assoc($result);

if (!$user) { echo "❌ ไม่พบผู้ใช้"; exit(); }

$error = "";
$success = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = isset($_POST['username']) ? mysqli_real_escape_string($conn, $_POST['username']) : '';
    $password = isset($_POST['password']) ? mysqli_real_escape_string($conn, $_POST['password']) : '';
    $name     = isset($_POST['name']) ? mysqli_real_escape_string($conn, $_POST['name']) : '';
    $phone    = isset($_POST['phone']) ? mysqli_real_escape_string($conn, $_POST['phone']) : '';
    $role     = isset($_POST['role']) ? mysqli_real_escape_string($conn, $_POST['role']) : '';

    if (!empty($username) && !empty($name) && !empty($role)) {
        // ตรวจสอบซ้ำ (ยกเว้นตัวเอง)
        $check = mysqli_query($conn, "SELECT * FROM admin WHERE A_Username='$username' AND A_ID!=$id");
        if (mysqli_num_rows($check) > 0) {
            $error = "❌ ชื่อผู้ใช้ซ้ำ";
        } else {
            if (!empty($password)) {
                $hash_pass = password_hash($password, PASSWORD_DEFAULT);
                $sql = "UPDATE admin SET A_Username='$username', A_Password='$hash_pass', A_Name='$name', A_Role='$role', A_Phone='$phone' WHERE A_ID=$id";
            } else {
                $sql = "UPDATE admin SET A_Username='$username', A_Name='$name', A_Role='$role', A_Phone='$phone' WHERE A_ID=$id";
            }
            if (mysqli_query($conn, $sql)) {
                $success = "✅ แก้ไขผู้ใช้เรียบร้อยแล้ว";
                $user = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM admin WHERE A_ID=$id"));
            } else {
                $error = "❌ เกิดข้อผิดพลาด: ".mysqli_error($conn);
            }
        }
    } else {
        $error = "กรุณากรอกข้อมูลให้ครบถ้วน";
    }
}
?>
<!DOCTYPE html>
<html lang="th">
<head>
<meta charset="UTF-8">
<title>แก้ไขผู้ใช้</title>
<link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Prompt:wght@400;600;700&display=swap" rel="stylesheet">
<style>
body, input, textarea, select, button, label, h1,h2,h3,h4,h5,h6 { font-family:'Prompt',sans-serif !important;}
body {
    margin:0; padding:0;
    background: linear-gradient(135deg,#0f0f0f,#1c1c1c);
    color:#fff;
    display:flex;
    justify-content:center;
    align-items:center;
    min-height:100vh;
}
.container { width:100%; max-width:450px; padding:20px; }
.form-card {
    background:#181818;
    padding:40px;
    border-radius:20px;
    box-shadow:0 8px 25px rgba(0,0,0,0.6);
}
.form-card h2 { color:#f44336; margin-bottom:25px; font-weight:700; text-align:center; }
.form-group { display:flex; flex-direction:column; margin-bottom:18px; }
.form-group label { margin-bottom:6px; font-weight:600; color:#ccc; }
.form-control {
    background:#202020;
    border:1px solid #333;
    color:#fff;
    border-radius:12px;
    padding:12px 14px;
}
.form-control:focus {
    border-color:#f44336;
    box-shadow:0 0 0 0.25rem rgba(244,67,54,.35);
    background:#1a1a1a;
    color:#fff;
}
.btn-submit {
    background:linear-gradient(45deg,#f44336,#b71c1c);
    border:none;
    border-radius:30px;
    font-weight:600;
    padding:12px 30px;
    color:#fff;
    width:100%;
    margin-top:10px;
    transition:0.3s;
}
.btn-submit:hover { opacity:0.9; transform:translateY(-2px); }
.btn-back {
    background:#242424;
    border:1px solid #444;
    color:#fff;
    border-radius:30px;
    font-weight:500;
    padding:12px 30px;
    display:block;
    text-align:center;
    text-decoration:none;
    margin-top:15px;
}
.btn-back:hover { background:#f44336; border-color:#f44336; color:#fff; }
.alert { border-radius:12px; margin-bottom:20px; font-size:0.95rem; text-align:center; }
</style>
</head>
<body>
<div class="container">
  <div class="form-card">
    <h2>แก้ไขผู้ใช้</h2>
    <?php if(!empty($error)) echo "<div class='alert alert-danger'>$error</div>"; ?>
    <?php if(!empty($success)) echo "<div class='alert alert-success'>$success</div>"; ?>
    <form method="post">
      <div class="form-group">
        <label>Username</label>
        <input type="text" name="username" class="form-control" value="<?= htmlspecialchars($user['A_Username']) ?>" required>
      </div>
      <div class="form-group">
        <label>Password (กรอกเฉพาะถ้าต้องการเปลี่ยน)</label>
        <input type="password" name="password" class="form-control">
      </div>
      <div class="form-group">
        <label>ชื่อ-นามสกุล</label>
        <input type="text" name="name" class="form-control" value="<?= htmlspecialchars($user['A_Name']) ?>" required>
      </div>
      <div class="form-group">
        <label>เบอร์โทร</label>
        <input type="text" name="phone" class="form-control" value="<?= htmlspecialchars($user['A_Phone']) ?>">
      </div>
      <div class="form-group">
        <label>Role</label>
        <select name="role" class="form-control" required>
          <option value="Admin" <?= ($user['A_Role']=='Admin')?'selected':'' ?>>Admin</option>
          <option value="Owner" <?= ($user['A_Role']=='Owner')?'selected':'' ?>>Owner</option>
        </select>
      </div>
      <button type="submit" class="btn-submit">บันทึกการแก้ไข</button>
    </form>
    <a href="manage_users.php" class="btn-back">กลับสู่แดชบอร์ด</a>
  </div>
</div>
</body>
</html>
