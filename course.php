<?php
// course.php
?>
<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Courses - YJ Creating</title>
    <!-- Font + Icon -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@500;700&family=Prompt:wght@300;400;500;600&display=swap" rel="stylesheet">

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

        .navbar .menu {
            flex: 1;
            display: flex;
            justify-content: center;
            gap: 30px;
        }

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
            font-family: 'Montserrat', sans-serif;
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

        /* Courses Section */
        .courses {
            padding: 60px 20px;
            background: #111;
        }
        .courses .container {
            max-width: 1100px;
            margin: auto;
        }
        .courses h2 {
            text-align: center;
            font-family: 'Prompt', sans-serif;
            font-size: 2rem;
            font-weight: 600;
            color: #c22c0a;
            margin-bottom: 40px;
        }

        .course-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 25px;
        }

        .course-card {
            background: #222;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 4px 6px rgba(255,255,255,0.05);
            transition: transform 0.3s;
        }
        .course-card:hover { transform: translateY(-8px); }

        .course-card img {
            width: 100%;
            height: 180px;
            object-fit: cover;
        }

        .course-card .content {
            padding: 20px;
            text-align: center;
        }

        .course-card h3 {
            font-family: 'Prompt', sans-serif;
            font-size: 1.3rem;
            margin-bottom: 10px;
            color: #c22c0a;
        }

        .course-card p {
            font-family: 'Prompt', sans-serif;
            font-size: 0.95rem;
            color: #ddd;
            margin-bottom: 10px;
            text-align: left;
        }

        .course-card .price {
            font-weight: bold;
            color: #ffb74d;
            margin-bottom: 10px;
        }

        .course-card .teacher {
            font-style: italic;
            color: #aaa;
            margin-bottom: 15px;
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
        <h1>Our Courses</h1>
        <p>เลือกคอร์สเรียนสนุก ๆ ที่จะช่วยเสริมทักษะ สร้างผลงาน และประสบการณ์ใหม่ ✨</p>
    </section>

    <!-- COURSE LIST -->
    <section class="courses">
        <div class="container">
            <h2>คอร์สเรียนที่เปิดรับสมัคร</h2>
            <div class="course-grid">

                <!-- Course 1 -->
                <div class="course-card">
                    <img src="image/course1.png" alt="Content Creator & Youtuber">
                    <div class="content">
                        <h3>Content Creator & Youtuber</h3>
                        <div class="teacher">ครู Ichi</div>
                        <div class="price">ราคา: 5,900 บาท / 8 ชั่วโมง</div>
                        <p>เนื้อหาการเรียน:</p>
                        <ul style="text-align:left; color:#ddd; margin-left:15px;">
                            <li>การทำคอนเทนต์บน YouTube และแพลตฟอร์มอื่นๆ</li>
                            <li>การร้องเพลง (Singing)</li>
                            <li>เล่นดนตรี (Piano, Guitar)</li>
                            <li>เขียนเพลง & แต่งเพลง</li>
                            <li>การทำ Voice Over และการพูดพิธีกร (MC)</li>
                            <li>การแสดงโชว์ผ่าน Free VDO Showcase</li>
                            <li>กิจกรรมพิเศษ: ออก Event ทุกเดือน</li>
                        </ul>
                    </div>
                </div>

                <!-- Course 2 -->
                <div class="course-card">
                    <img src="image/course2.png" alt="Singing & Personality">
                    <div class="content">
                        <h3>Singing & Personality</h3>
                        <div class="teacher">ครูเบลล่า</div>
                        <div class="price">ราคา: 4,900 บาท / 8 ชั่วโมง</div>
                        <p>เนื้อหาการเรียน:</p>
                        <ul style="text-align:left; color:#ddd; margin-left:15px;">
                            <li>เทคนิคการร้องเพลงพื้นฐาน & ขั้นสูง</li>
                            <li>การใช้เสียง และการปรับโทนเสียง</li>
                            <li>การพัฒนา บุคลิกภาพ (Personality Development)</li>
                            <li>การพูด การแสดง และการสื่อสารบนเวที</li>
                        </ul>
                    </div>
                </div>

                <!-- Course 3 -->
                <div class="course-card">
                  <img src="image/course3.png" alt="Youtuber & Editing">
                    <div class="content">
                        <h3>Youtuber & Editing</h3>
                        <div class="teacher">ครูต๊ะ, ครูโจม</div>
                        <div class="price">ราคา: 4,900 บาท / 8 ชั่วโมง</div>
                        <p>เนื้อหาการเรียน:</p>
                        <ul style="text-align:left; color:#ddd; margin-left:15px;">
                            <li>การสร้างคอนเทนต์ YouTube ตั้งแต่ 0</li>
                            <li>การใช้ Canva ทำกราฟิก & โปสเตอร์</li>
                            <li>Roblox Game Content การเล่นและทำคลิปเกม</li>
                            <li>การใช้ CapCut ตัดต่อวิดีโอ</li>
                            <li>การเล่าเรื่อง (Storytelling) และการนำเสนอ</li>
                        </ul>
                    </div>
                </div>

            </div>
        </div>
    </section>
</main>

</body>
</html>
