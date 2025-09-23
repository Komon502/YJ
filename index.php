<?php
include 'admin/db_connect.php';

// ดึงข้อมูลจาก DB
$today = date('Y-m-d');
$sql = "SELECT * FROM event WHERE E_EndDate >= '$today' ORDER BY E_StartDate ASC";
$result = mysqli_query($conn, $sql);

$events = [];
while ($row = mysqli_fetch_assoc($result)) {
    $events[] = $row;
}
?>
<!DOCTYPE html>
<html lang="th">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>YJ creating</title>

  <!-- Bootstrap -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

  <!-- Font + Icon -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@500;700&family=Kanit:wght@500;700&family=Prompt:wght@300;400;500;600&display=swap" rel="stylesheet">

  <style>
    body { font-family: 'Prompt', sans-serif; background: #000; color: #fff; margin: 0; padding: 0; }

    /* Navbar */
    .navbar { display: flex; justify-content: space-between; align-items: center; padding: 15px 50px; background: #111; }
    .navbar .logo img { height: 50px; }
    .navbar .menu { flex: 1; display: flex; justify-content: center; gap: 30px; }
    .navbar .menu a { text-decoration: none; font-family: 'Montserrat', sans-serif; font-weight: 600; color: #fff; }
    .navbar .menu a:hover { color: #c22c0a; }
    .navbar .login a { text-decoration: none; font-weight: 600; background: #c22c0a; color: #fff; padding: 8px 18px; border-radius: 25px; }
    .navbar .login a:hover { background: #ea6344; }

    /* Hero */
    .hero { padding: 80px 20px; background: url('image/bg2.jpg') no-repeat center center/cover; position: relative; text-align: center; }
    .hero::after { content: ""; position: absolute; inset: 0; background: rgba(0, 0, 0, 0.5); }
    .hero-content { position: relative; z-index: 1; }
    .hero-content h1 { font-family: 'Kanit', sans-serif; font-size: 3rem; color: #c22c0a; margin-bottom: 15px; }
    .hero-content p { color: #eee; max-width: 700px; margin: auto; }

    /* Features Section */
    .features { padding: 60px 20px; background: #111; text-align: center; }
    .features h2 { font-family: 'Kanit', sans-serif; font-size: 2rem; margin-bottom: 30px; color: #ff7043; }

    /* Event Card */
    .event-card {
      background: #1a1a1a;
      padding: 20px;
      border-radius: 20px;
      width: 100%;
      max-width: 400px;   /* ใหญ่ขึ้น */
      margin: 0 auto 25px auto;
      box-shadow: 0 6px 18px rgba(0,0,0,0.6);
      transition: transform 0.3s, box-shadow 0.3s;
      display: flex;
      flex-direction: column;
      text-align: left;
    }
    .event-card:hover { 
      transform: translateY(-6px); 
      box-shadow: 0 12px 25px rgba(255,87,51,0.3); 
    }
    .event-card img { 
      width: 100%; 
      height: 250px;      /* รูปใหญ่ขึ้น */
      border-radius: 12px; 
      object-fit: cover; 
      margin-bottom: 15px; 
    }
    .event-card h3 { 
      color: #ff7043; 
      font-size: 1.5rem;  
      margin-bottom: 8px; 
    }
    .event-card p { 
      color: #ccc; 
      font-size: 1rem; 
      margin-bottom: 12px; 
    }
    .event-card small { 
      display: block; 
      color: #aaa; 
      font-size: 0.9rem; 
      margin-bottom: 6px;
    }

    /* Carousel Control */
    .carousel-indicators {
      position: relative;
      margin-top: 20px;
    }
    .carousel-indicators button {
      background-color: #ff7043;
      width: 12px;
      height: 12px;
      border-radius: 50%;
    }
    .carousel-control-prev-icon,
    .carousel-control-next-icon {
      background-color: rgba(0,0,0,0.6);
      border-radius: 50%;
      padding: 20px;
    }
  </style>
</head>
<body>
  <!-- Navbar -->
  <header>
    <div class="navbar">
      <div class="logo"><img src="image/YJ.png" alt="YJ Logo"></div>
      <nav class="menu">
        <a href="index.php">HOME</a>
        <a href="about.php">ABOUT</a>
        <a href="course.php">COURSE</a>
        <a href="contact.php">CONTACT</a>
      </nav>
      <div class="login"><a href="admin/login.php">LOGIN</a></div>
    </div>
  </header>

  <!-- Hero -->
  <section class="hero">
    <div class="hero-content">
      <h1>YJ creating</h1>
      <p>▶️ มาเล่นกันเถอะ เรียนแบบเล่น ๆ เน้นสนุก เน้นสร้างผลงาน และเติมประสบการณ์แบบมืออาชีพ ให้เด็กทุกคนตามสไตล์ YJ ❤️</p>
    </div>
  </section>

  <!-- Events -->
  <?php if (!empty($events)) { ?>
  <section class="features">
    <h2><i class="fa-solid fa-calendar-days"></i> Events</h2>

    <div id="eventCarousel" class="carousel slide" data-bs-ride="carousel" data-bs-interval="4000">
      <div class="carousel-inner">
        <?php foreach (array_chunk($events, 3) as $chunkIndex => $chunk) { ?>
          <div class="carousel-item <?= $chunkIndex === 0 ? 'active' : '' ?>">
            <div class="row justify-content-center">
              <?php foreach ($chunk as $event) { ?>
                <div class="col-md-4">
                  <div class="event-card">
                    <?php if (!empty($event['E_Image'])) { ?>
                      <img src="uploads/<?= htmlspecialchars($event['E_Image']) ?>" alt="<?= htmlspecialchars($event['E_Title']) ?>">
                    <?php } ?>
                    <h3><?= htmlspecialchars($event['E_Title']) ?></h3>
                    <p><?= htmlspecialchars($event['E_Detail']) ?></p>
                    <small><i class="fa-solid fa-calendar-days"></i> <?= $event['E_StartDate'] ?> → <?= $event['E_EndDate'] ?></small>
                    <small><i class="fa-solid fa-location-dot"></i> <?= htmlspecialchars($event['E_Location']) ?></small>
                  </div>
                </div>
              <?php } ?>
            </div>
          </div>
        <?php } ?>
      </div>

      <!-- Indicators -->
      <div class="carousel-indicators">
        <?php foreach (array_chunk($events, 3) as $chunkIndex => $chunk) { ?>
          <button type="button" data-bs-target="#eventCarousel" data-bs-slide-to="<?= $chunkIndex ?>" class="<?= $chunkIndex === 0 ? 'active' : '' ?>"></button>
        <?php } ?>
      </div>
    </div>
  </section>
  <?php } ?>

  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
