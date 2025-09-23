<?php
// contact.php
?>
<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact - YJ creating</title>
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@500;700&family=Kanit:wght@500;700&family=Prompt:wght@300;400;500;600&display=swap" rel="stylesheet">

    <style>
        * { margin:0; padding:0; box-sizing:border-box; }

        body { font-family:"Prompt", sans-serif; line-height:1.7; color:#ddd; background:#111; }

        /* Navbar */
        .navbar {
            display:flex;
            justify-content:space-between;
            align-items:center;
            padding:15px 50px;
            background:#111;
        }
        .navbar .logo img { height:50px; }
        .navbar .menu { flex:1; display:flex; justify-content:center; gap:30px; }
        .navbar .menu a {
            text-decoration:none;
            font-family:'Montserrat', sans-serif;
            font-weight:600;
            font-size:1rem;
            letter-spacing:1px;
            color:#fff;
            transition:0.3s;
        }
        .navbar .menu a:hover { color:#c22c0a; }
        .navbar .login a {
            text-decoration:none;
            font-weight:600;
            font-family:'Montserrat', sans-serif;
            background:#c22c0a;
            color:#fff;
            padding:8px 18px;
            border-radius:25px;
            transition:0.3s;
        }
        .navbar .login a:hover { background:#ea6344; }

        /* Hero */
        .hero {
            padding:80px 20px;
            text-align:center;
            background: url('image/bg2.jpg') no-repeat center center/cover;
            color:#fff;
        }
        .hero h1 {
            font-family:'Kanit', sans-serif;
            font-size:3rem;
            font-weight:700;
            color:#c22c0a;
            margin-bottom:15px;
            letter-spacing:2px;
        }
        .hero p {
            font-family:'Prompt', sans-serif;
            max-width:700px;
            margin:0 auto;
            color:#ccc;
            font-size:1.1rem;
        }

        /* Contact Section */
        .contact { padding:60px 20px; background:#111; }
        .contact .container { max-width:800px; margin:auto; }
        .contact h2 {
            font-family:'Kanit', sans-serif;
            font-size:2rem;
            font-weight:600;
            color:#c22c0a;
            margin-bottom:25px;
            text-align:center;
        }
        .social-links {
            display:flex;
            justify-content:center;
            gap:50px;
            flex-wrap:wrap;
            margin-top:30px;
        }
        .social-links .icon-box { text-align:center; }
        .social-links a {
            font-size:2.5rem;
            color:#fff;
            transition:0.3s;
        }
        .social-links a:hover { color:#c22c0a; }
        .social-links p { margin-top:10px; font-size:1rem; color:#ddd; font-family:'Prompt', sans-serif; }
    </style>
</head>
<body>

<header>
    <div class="navbar">
        <div class="logo"><img src="image/YJ.png" alt="YJ Logo"></div>
        <nav class="menu">
            <a href="index.php">HOME</a>
            <a href="about.php">ABOUT</a>
            <a href="course.php">COURSE</a>
            <a href="contact.php">CONTACT</a>
        </nav>
        <div class="login"><a href="login.php">LOGIN</a></div>
    </div>
</header>

<main>
    <!-- HERO -->
    <section class="hero">
        <h1>Contact Us</h1>
        <p>สนใจสมัครเรียนที่ YJ ติดต่อเราได้ผ่านช่องทางโซเชียลด้านล่างนี้ ✨</p>
    </section>

    <!-- CONTACT DETAIL -->
    <section class="contact">
        <div class="container">
            <h2>ช่องทางการติดต่อ</h2>
            <div class="social-links">
                <div class="icon-box">
                    <a href="https://www.facebook.com/YJcreating" target="_blank"><i class="fab fa-facebook"></i></a>
                    <p>Facebook</p>
                </div>
                <div class="icon-box">
                    <a href="https://line.me/R/ti/p/@315wncfs?ts=09181649&oat_content=url" target="_blank"><i class="fab fa-line"></i></a>
                    <p>Line</p>
                </div>
                <div class="icon-box">
                    <a href="https://www.tiktok.com/@YJcreating" target="_blank"><i class="fab fa-tiktok"></i></a>
                    <p>TikTok</p>
                </div>
            </div>
        </div>
    </section>
</main>

</body>
</html>
