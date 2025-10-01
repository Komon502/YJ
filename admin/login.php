<?php
session_start();

$error = "";
$show_animation = false;

// 🔐 กำหนดรหัส admin ที่ใช้ได้แค่ 1 account
$fixed_username = "admin";
$fixed_password = "1111"; // 👉 ควรเปลี่ยนเป็นรหัสที่คุณตั้ง

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    if ($username === $fixed_username && $password === $fixed_password) {
        $_SESSION['is_admin'] = true;
        $_SESSION['A_Username'] = $username;
        header("Location: admin_dashboard.php");
        exit();
    } else {
        $error = "❌ ชื่อผู้ใช้หรือรหัสผ่านไม่ถูกต้อง";
        $show_animation = true;
    }
}
?>
<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <title>เข้าสู่ระบบ - Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { 
            background:#000; 
            color:#fff; 
            font-family:'Prompt', sans-serif; 
            display:flex; 
            justify-content:center; 
            align-items:center; 
            height:100vh;
            overflow:hidden;
        }
        .login-box { 
            background:#111; 
            padding:40px; 
            border-radius:15px; 
            width:100%; 
            max-width:400px; 
            box-shadow:0 6px 20px rgba(255,87,51,0.3);
            position:relative;
        }
        h2 { 
            text-align:center; 
            margin-bottom:25px; 
            color:#ff7043; 
        }
        .form-control { 
            background:#222; 
            border:1px solid #555; 
            color:#fff; 
        }
        .form-control:focus { 
            border-color:#ff7043; 
            box-shadow:0 0 8px rgba(255,112,67,.7); 
        }
        .btn-login { 
            background:linear-gradient(45deg,#ff7043,#c22c0a); 
            border:none; 
            width:100%; 
            font-weight:600;
            transition: all 0.3s ease;
            position: relative;
        }
        .btn-login:hover { 
            background:linear-gradient(45deg,#ff5733,#a62808);
            transform: scale(1.02);
        }

        /* 🎯 Animation สำหรับปุ่มหนี */
        .btn-escape {
            animation: escapeButton 0.5s ease-out forwards;
        }

        @keyframes escapeButton {
            0% { transform: translateX(0) translateY(0); }
            25% { transform: translateX(-150px) translateY(-50px) rotate(-15deg); }
            50% { transform: translateX(150px) translateY(50px) rotate(15deg); }
            75% { transform: translateX(-100px) translateY(-80px) rotate(-10deg); }
            100% { transform: translateX(200px) translateY(-100px) rotate(20deg) scale(0.5); opacity: 0; }
        }

        /* 🔴 Animation สำหรับฟอร์มสั่น */
        .shake {
            animation: shake 0.5s;
        }

        @keyframes shake {
            0%, 100% { transform: translateX(0); }
            10%, 30%, 50%, 70%, 90% { transform: translateX(-10px); }
            20%, 40%, 60%, 80% { transform: translateX(10px); }
        }

        /* ⚠️ Alert Animation */
        .alert-animated {
            animation: slideDown 0.5s ease-out;
        }

        @keyframes slideDown {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* 🔄 Reset button after animation */
        .btn-reset {
            animation: resetButton 0.5s ease-in forwards;
        }

        @keyframes resetButton {
            from {
                opacity: 0;
                transform: translateX(200px) translateY(-100px) scale(0.5);
            }
            to {
                opacity: 1;
                transform: translateX(0) translateY(0) scale(1);
            }
        }
    </style>
</head>
<body>
    <div class="login-box <?php echo $show_animation ? 'shake' : ''; ?>">
        <h2>🔑 เข้าสู่ระบบผู้ดูแล</h2>
        <?php if ($error) echo "<div class='alert alert-danger text-center alert-animated'>$error</div>"; ?>
        <form method="post" id="loginForm">
            <div class="mb-3">
                <label>ชื่อผู้ใช้</label>
                <input type="text" name="username" class="form-control" required>
            </div>
            <div class="mb-3">
                <label>รหัสผ่าน</label>
                <input type="password" name="password" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-login" id="loginBtn">เข้าสู่ระบบ</button>
        </form>
    </div>

    <script>
        <?php if ($show_animation): ?>
        // เมื่อมีการ login ผิด ให้ปุ่มหนี
        document.addEventListener('DOMContentLoaded', function() {
            const btn = document.getElementById('loginBtn');
            btn.classList.add('btn-escape');
            
            // หลังจาก animation เสร็จ ให้ปุ่มกลับมา
            setTimeout(function() {
                btn.classList.remove('btn-escape');
                btn.classList.add('btn-reset');
                setTimeout(function() {
                    btn.classList.remove('btn-reset');
                }, 500);
            }, 500);
        });
        <?php endif; ?>
    </script>
</body>
</html>