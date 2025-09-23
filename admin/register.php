<?php
include 'db_connect.php'; // ไฟล์เชื่อมต่อฐานข้อมูล

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // รับค่าจากฟอร์มและป้องกัน SQL Injection
    $A_Username = mysqli_real_escape_string($conn, $_POST['A_Username']);
    $A_Name     = mysqli_real_escape_string($conn, $_POST['A_Name']);
    $A_Role     = mysqli_real_escape_string($conn, $_POST['A_Role']);
    $A_Phone    = mysqli_real_escape_string($conn, $_POST['A_Phone']);
    $A_Password = password_hash($_POST['A_Password'], PASSWORD_DEFAULT); // เข้ารหัส Password

    // ตรวจสอบว่า Username ซ้ำหรือไม่
    $check  = "SELECT * FROM admin WHERE A_Username = '$A_Username'";
    $result = mysqli_query($conn, $check);

    if ($result) {
        if (mysqli_num_rows($result) == 0) {
            // ถ้าไม่ซ้ำ → เพิ่มข้อมูล
            $sql = "INSERT INTO admin (A_Username, A_Password, A_Name, A_Role, A_Phone) 
                    VALUES ('$A_Username','$A_Password','$A_Name','$A_Role','$A_Phone')";

            if (mysqli_query($conn, $sql)) {
                header("Location: login.php");
                exit();
            } else {
                // ถ้า insert fail ให้โชว์ error ที่แท้จริง
                echo "❌ เกิดข้อผิดพลาดในการลงทะเบียน: " . mysqli_error($conn);
            }
        } else {
            echo "❌ Username นี้ถูกใช้แล้ว!";
        }
    } else {
        // ถ้า query ตรวจสอบ username fail ให้โชว์ error
        echo "❌ เกิดข้อผิดพลาดในการตรวจสอบ Username: " . mysqli_error($conn);
    }
}
?>
<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <title>สมัครสมาชิก - YJ Creating</title>
    <link href="https://fonts.googleapis.com/css2?family=Prompt:wght@200;400;600&display=swap" rel="stylesheet">
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <style>
        * { font-family: 'Prompt', sans-serif; }
        body { background:#000; color:#fff; margin:0; }
        .register-container { display:flex; flex-direction:column; align-items:center; justify-content:center; min-height:100vh; padding:20px; text-align:center; }
        .card { background:#111; border:none; border-radius:15px; box-shadow:0 4px 15px rgba(255,255,255,0.1); width:100%; max-width:450px; padding:30px 25px; }
        .card h2 { color:#ff5733; margin-bottom:10px; font-size:1.6rem; }
        .card h4 { font-weight:300; color:#bbb; margin-bottom:20px; font-size:1rem; }
        .form-control { background:#222; border:1px solid #333; color:#fff; padding:10px 12px; text-align:center; }
        .form-control:focus { border-color:#ff5733; box-shadow:none; }
        .btn-register { background:#ff5733; border:none; border-radius:25px; padding:10px; font-weight:bold; color:#fff; transition:0.3s; font-size:1rem; margin-top:10px; }
        .btn-register:hover { background:#c70039; }
        .login-link { display:block; margin-top:15px; color:#bbb; text-decoration:none; font-size:0.9rem; }
        .login-link:hover { color:#ff5733; }
        .error { color:red; margin-top:10px; }
    </style>
</head>
<body>
    <div class="register-container">
        <div class="card">
            <h2>สมัครสมาชิก</h2>
            <h4>YJ Creating Admin</h4>

            <?php if (!empty($error)) { ?>
                <div class="alert alert-danger"><?= $error; ?></div>
            <?php } ?>

            <form method="POST" action="">
                <div class="form-group mb-3">
                    <input type="text" class="form-control" name="A_Email" placeholder="Email" required>
                </div>
                <div class="form-group mb-3">
                    <input type="text" class="form-control" name="A_Username" placeholder="Username" required>
                </div>
                <div class="form-group mb-3">
                    <input type="password" class="form-control" name="A_Password" placeholder="Password" required>
                </div>
                <div class="form-group mb-3">
                    <input type="text" class="form-control" name="A_Name" placeholder="ชื่อ-นามสกุล" required>
                </div>
                <div class="form-group mb-3">
                    <input type="text" class="form-control" name="A_Phone" placeholder="เบอร์โทรศัพท์">
                </div>
                <button type="submit" class="btn btn-register w-100">สมัครสมาชิก</button>
            </form>

            <a href="login.php" class="login-link">มีบัญชีแล้ว? เข้าสู่ระบบ</a>
        </div>
    </div>
</body>
</html>
