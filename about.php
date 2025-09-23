<?php
// about.php
?>
<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About - YJ creating</title>
    <!-- Font + Icon -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@500;700&family=Kanit:wght@500;700&family=Prompt:wght@300;400;500;600&display=swap" rel="stylesheet">

    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }

        .hero {
      padding: 80px 20px;
      background: url('image/bg2.jpg') no-repeat center center/cover;
      position: relative;
      color: #fff;
        }

        /* Navbar */
        .navbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 15px 50px;
            background: #111;
        }
        .navbar .logo img { height: 50px; }
        .navbar .menu { flex: 1; display: flex; justify-content: center; gap: 30px; }
        .navbar .menu a {
            text-decoration: none;
            font-family: 'Montserrat', sans-serif;
            font-weight: 600;
            font-size: 1rem;
            letter-spacing: 1px;
            color: #fff;
            transition: color 0.3s;
        }
        .navbar .menu a:hover { color: #c22c0a; }
        .navbar .login a {
            text-decoration: none;
            font-weight: 600;
            font-family: 'Montserrat', sans-serif;
            background: #c22c0a;
            color: #fff;
            padding: 8px 18px;
            border-radius: 25px;
            transition: 0.3s;
        }
        .navbar .login a:hover { background: #ea6344; }

        /* Hero */
        .hero {
            padding: 80px 20px;
            text-align: center;
        }
        .hero h1 {
            font-family: 'Kanit', sans-serif;
            font-size: 3rem;
            font-weight: 700;
            color: #c22c0a;
            margin-bottom: 15px;
            letter-spacing: 2px;
        }
        .hero p {
            font-family: 'Prompt', sans-serif;
            max-width: 700px;
            margin: 0 auto;
            color: #ccc;
            font-size: 1.1rem;
        }

        /* About Section */
        .about {
            padding: 60px 20px;
            background: #111;
        }
        .about .container {
            max-width: 1000px;
            margin: auto;
            display: flex;
            flex-wrap: wrap;
            gap: 30px;
            align-items: center;
            justify-content: center;
        }
        .about img {
            max-width: 200px;
            border-radius: 10px;
        }
        .about .content {
            flex: 1;
            min-width: 280px;
            text-align: left;
        }
        .about .content h2 {
            font-family: 'Kanit', sans-serif;
            font-size: 2rem;
            color: #c22c0a;
            margin-bottom: 20px;
        }
        .about .content p {
            font-family: 'Prompt', sans-serif;
            font-size: 1rem;
            color: #ddd;
            margin-bottom: 15px;
        }

        /* TEAM Section */
        .team {
            padding: 60px 20px;
            background: #000;
        }
        .team h2 {
            text-align: center;
            font-family: 'Kanit', sans-serif;
            font-size: 2rem;
            font-weight: 700;
            color: #c22c0a;
            margin-bottom: 40px;
        }
        .team-grid-single {
            display: flex;
            justify-content: center;
        }
        .team-card-single {
            background: #222;
            border-radius: 15px;
            text-align: center;
            padding: 30px 20px;
            box-shadow: 0 6px 12px rgba(255,255,255,0.1);
            transition: transform 0.3s;
            max-width: 300px;
        }
        .team-card-single:hover { transform: translateY(-8px); }
        .team-card-single img {
            width: 150px;
            height: 150px;
            border-radius: 50%;
            margin-bottom: 15px;
            object-fit: cover;
        }
        .team-card-single h3 {
            font-family: 'Kanit', sans-serif;
            font-size: 1.1rem; /* ลดขนาดให้ชื่ออยู่บรรทัดเดียว */
            line-height: 1.2;
            margin-bottom: 5px;
            color: #c22c0a;
        }
        .team-card-single p {
            font-family: 'Prompt', sans-serif;
            font-size: 1rem;
            color: #ddd;
            margin-bottom: 5px;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .about .container {
                flex-direction: column;
            }
            .about img {
                margin-bottom: 20px;
            }
        }
    </style>
</head>
<body>

<header>
    <div class="navbar">
        <div class="logo">
            <img src="image/YJ.png" alt="YJ Logo">
        </div>
        <nav class="menu">
            <a href="index.php">HOME</a>
            <a href="about.php">ABOUT</a>
            <a href="course.php">COURSE</a>
            <a href="contact.php">CONTACT</a>
        </nav>
        <div class="login">
            <a href="login.php">LOGIN</a>
        </div>
    </div>
</header>

<main>
    <!-- HERO -->
    <section class="hero">
        <h1>About Us</h1>
        <p>รู้จัก YJ creating ให้มากขึ้น 💡 เราคือทีมที่เชื่อว่าการเรียนรู้ควรสนุก และทุกคนสามารถสร้างผลงานที่ไม่เหมือนใครได้</p>
    </section>

    <!-- ABOUT -->
    <section class="about">
        <div class="container">
            <img src="image/YJ1.png" alt="About YJ creating">
            <div class="content">
                <h2>YJ creating คืออะไร?</h2>
                <p>YJ creating ก่อตั้งขึ้นเพื่อสร้างพื้นที่ให้เด็กและเยาวชนได้เรียนรู้แบบ “สนุก” พร้อมสร้างผลงานที่จับต้องได้จริง และเสริมทักษะให้ก้าวสู่ความเป็น Creator มืออาชีพ</p>
                <p>เราเชื่อว่าทุกคนมีความคิดสร้างสรรค์ในแบบของตัวเอง และภารกิจของเราคือการช่วยให้เด็ก ๆ ได้ค้นพบพลังนั้น 💪</p>
            </div>
        </div>
    </section>

    <!-- TEAM -->
    <section class="team">
        <h2>ผู้บริหาร</h2>
        <div class="team-grid-single">
            <div class="team-card-single">
                <img src="image/owner.jpg" alt="Founder">
                <h3>คุณปฏิภาณ เตียเจริญวรรธน์ (ฌิ)</h3>
                <p>YJ Founder & CEO</p>
                <p>เบอร์ติดต่อ: 062-324-6561</p>
            </div>
        </div>
    </section>
</main>

</body>
</html>
