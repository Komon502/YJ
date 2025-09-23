<?php
session_start();
include 'db_connect.php';

if (!isset($_SESSION['A_Username'])) {
    header("Location: login.php");
    exit();
}

$result = mysqli_query($conn, "SELECT * FROM course");
?>
<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <title>จัดการคอร์ส - YJ Creating</title>
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Prompt:wght@300;400;500;600;700&family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            background: #0b0b0b;
            color: #e0e0e0;
            font-family: 'Prompt', 'Poppins', sans-serif;

            /* ✅ จัดให้อยู่กลางจอ */
            margin: 0;
            height: 100vh;
            display: flex;
            justify-content: center; /* จัดกึ่งกลางแนวนอน */
            align-items: center;     /* จัดกึ่งกลางแนวตั้ง */
        }
        h1 {
            color: #ffffff;
            font-weight: 700;
            margin-bottom: 30px;
            text-align: center;
        }
        .card-container {
            background: #111;
            border-radius: 20px;
            padding: 30px;
            padding-bottom: 80px; /* ✅ เพิ่มพื้นที่ด้านล่าง */
            box-shadow: 0 8px 25px rgba(0,0,0,0.6);
            position: relative;
            max-width: 1100px;
            width: 100%;
        }
        .btn-add-course {
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
        a.btn-secondary { 
            background: #333; 
            border: none; 
            color: #fff; 
            text-decoration: none;
        }
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
    </style>
</head>
<body>
    <div class="card-container">
        <h1>จัดการคอร์ส</h1>
        
        <!-- ปุ่มเพิ่มคอร์ส -->
        <a href="add_course.php" class="btn btn-success btn-add-course">เพิ่มคอร์สใหม่</a>

        <table class="table table-dark text-center align-middle">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>ชื่อคอร์ส</th>
                    <th>คำอธิบาย</th>
                    <th>ระยะเวลา</th>
                    <th>ค่าใช้จ่าย</th>
                    <th>การจัดการ</th>
                </tr>
            </thead>
            <tbody>
                <?php while($row = mysqli_fetch_assoc($result)){ ?>
                <tr>
                    <td><?= $row['CourseID'] ?></td>
                    <td><?= $row['CourseName'] ?></td>
                    <td><?= $row['Description'] ?></td>
                    <td><?= $row['Duration'] ?></td>
                    <td><?= $row['Fee'] ?></td>
                    <td>
                        <a href="edit_course.php?id=<?= $row['CourseID'] ?>" class="btn btn-warning btn-sm">✏️ แก้ไข</a>
                        <a href="delete_course.php?id=<?= $row['CourseID'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('แน่ใจว่าจะลบคอร์สนี้?');">🗑️ ลบ</a>
                    </td>
                </tr>
                <?php } ?>
            </tbody>
        </table>

        <!-- ปุ่มกลับแดชบอร์ด ขวาล่าง -->
        <a href="admin_dashboard.php" class="btn btn-secondary btn-bottom-right">กลับแดชบอร์ด</a>
    </div>
</body>
</html>
