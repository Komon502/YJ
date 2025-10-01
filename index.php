<?php
include __DIR__ . '/navbar.php';
include __DIR__ . '/db_connect.php';

// ฟังก์ชันเช็ค path ของรูป
function getImagePath($fileName) {
  if (!empty($fileName) && file_exists(__DIR__ . "/uploads/" . $fileName)) {
    return "uploads/" . $fileName;
  }
  return "image/no-image.png";
}
?>
<!DOCTYPE html>
<html lang="th">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>YJ Creating - Home</title>
  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    body {
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      background: #000;
      color: #fff;
      overflow-x: hidden;
    }

    /* ==================== HERO SECTION ==================== */
    .hero {
      position: relative;
      min-height: 70vh;
      display: flex;
      align-items: center;
      justify-content: center;
      background: #000;
      overflow: hidden;
    }

    .hero::before {
      content: '';
      position: absolute;
      width: 600px;
      height: 600px;
      background: radial-gradient(circle, rgba(255,87,51,0.15) 0%, transparent 70%);
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%);
      animation: pulse 8s ease-in-out infinite;
      border-radius: 50%;
      filter: blur(80px);
    }

    @keyframes pulse {
      0%, 100% { 
        transform: translate(-50%, -50%) scale(1);
        opacity: 0.5;
      }
      50% { 
        transform: translate(-50%, -50%) scale(1.2);
        opacity: 0.8;
      }
    }

    .hero-content {
      position: relative;
      z-index: 2;
      text-align: center;
      animation: fadeInUp 1s ease;
    }

    .hero-content h1 {
      font-size: 4rem;
      font-weight: 900;
      color: #fff;
      margin-bottom: 20px;
      text-shadow: 0 0 30px rgba(255,87,51,0.3);
    }

    .hero-content h1::first-letter {
      color: #ff5733;
    }

    .hero-content p {
      font-size: 1.3rem;
      color: #aaa;
      animation: fadeInUp 1.2s ease;
    }

    /* ==================== VIDEO SECTION ==================== */
    .video-section {
      max-width: 1400px;
      margin: 0 auto;
      padding: 60px 20px;
      position: relative;
    }

    .video-section h2 {
      font-size: 3rem;
      color: #fff;
      margin-bottom: 40px;
      position: relative;
      display: inline-block;
      animation: slideIn 0.8s ease;
    }

    .video-section h2::after {
      content: '';
      position: absolute;
      bottom: -10px;
      left: 0;
      width: 100px;
      height: 3px;
      background: #ff5733;
      animation: expandLine 0.8s ease 0.3s both;
    }

    .video-container {
      position: relative;
      width: 100%;
      max-width: 1000px;
      margin: 0 auto;
      border-radius: 20px;
      overflow: hidden;
      box-shadow: 0 20px 60px rgba(255,87,51,0.3);
      background: #0a0a0a;
      border: 1px solid #222;
      animation: cardFadeIn 0.8s ease forwards;
    }

    .video-wrapper {
      position: relative;
      padding-bottom: 56.25%;
      height: 0;
      overflow: hidden;
    }

    .video-wrapper iframe {
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      border: none;
    }

    .video-container::before {
      content: '';
      position: absolute;
      top: -2px;
      left: -2px;
      right: -2px;
      bottom: -2px;
      background: linear-gradient(45deg, #ff5733, #ffa500, #ff5733);
      border-radius: 20px;
      opacity: 0;
      transition: opacity 0.4s ease;
      z-index: -1;
      animation: borderGlow 3s linear infinite;
    }

    .video-container:hover::before {
      opacity: 0.6;
    }

    @keyframes borderGlow {
      0%, 100% { 
        background: linear-gradient(45deg, #ff5733, #ffa500, #ff5733);
      }
      50% { 
        background: linear-gradient(45deg, #ffa500, #ff5733, #ffa500);
      }
    }

    /* ==================== CONTAINER ==================== */
    .container {
      max-width: 1400px;
      margin: 0 auto;
      padding: 80px 20px;
    }

    .container h2 {
      font-size: 3rem;
      color: #fff;
      margin-bottom: 50px;
      position: relative;
      display: inline-block;
      animation: slideIn 0.8s ease;
    }

    .container h2::after {
      content: '';
      position: absolute;
      bottom: -10px;
      left: 0;
      width: 100px;
      height: 3px;
      background: #ff5733;
      animation: expandLine 0.8s ease 0.3s both;
    }

    @keyframes expandLine {
      from { width: 0; }
      to { width: 100px; }
    }

    /* ==================== EVENT GRID ==================== */
    .event-grid {
      display: grid;
      grid-template-columns: repeat(auto-fill, minmax(350px, 1fr));
      gap: 40px;
      margin-top: 40px;
    }

    .event-card {
      background: #0a0a0a;
      border-radius: 20px;
      overflow: hidden;
      border: 1px solid #222;
      transition: all 0.4s ease;
      opacity: 0;
      transform: translateY(30px);
      animation: cardFadeIn 0.6s ease forwards;
    }

    .event-card:nth-child(1) { animation-delay: 0.1s; }
    .event-card:nth-child(2) { animation-delay: 0.2s; }
    .event-card:nth-child(3) { animation-delay: 0.3s; }
    .event-card:nth-child(4) { animation-delay: 0.4s; }
    .event-card:nth-child(5) { animation-delay: 0.5s; }
    .event-card:nth-child(6) { animation-delay: 0.6s; }

    @keyframes cardFadeIn {
      to {
        opacity: 1;
        transform: translateY(0);
      }
    }

    .event-card:hover {
      transform: translateY(-10px);
      border-color: #ff5733;
      box-shadow: 0 15px 40px rgba(255,87,51,0.3);
    }

    .event-card::before {
      content: '';
      position: absolute;
      top: 0;
      left: -100%;
      width: 100%;
      height: 100%;
      background: linear-gradient(90deg, transparent, rgba(255,87,51,0.1), transparent);
      transition: left 0.6s;
      z-index: 1;
    }

    .event-card:hover::before {
      left: 100%;
    }

    /* ==================== IMAGE BOX ==================== */
    .event-img-box {
      position: relative;
      height: 250px;
      overflow: hidden;
      background: #000;
    }

    .event-img-box::after {
      content: '';
      position: absolute;
      bottom: 0;
      left: 0;
      right: 0;
      height: 50%;
      background: linear-gradient(to top, rgba(0,0,0,0.8), transparent);
      z-index: 1;
    }

    .event-img {
      width: 100%;
      height: 100%;
      object-fit: cover;
      transition: transform 0.6s ease;
      filter: brightness(0.8);
    }

    .event-card:hover .event-img {
      transform: scale(1.1);
      filter: brightness(1);
    }

    /* ==================== BADGES ==================== */
    .ribbon {
      position: absolute;
      top: 15px;
      left: 15px;
      background: #ff5733;
      color: #fff;
      padding: 8px 20px;
      border-radius: 20px;
      font-size: 0.75rem;
      font-weight: bold;
      z-index: 10;
      box-shadow: 0 4px 15px rgba(255,87,51,0.5);
      text-transform: uppercase;
      letter-spacing: 1px;
    }

    .tag {
      position: absolute;
      top: 15px;
      right: 15px;
      background: rgba(0,0,0,0.8);
      backdrop-filter: blur(10px);
      color: #fff;
      padding: 8px 16px;
      border-radius: 20px;
      font-size: 0.75rem;
      font-weight: bold;
      z-index: 10;
      border: 1px solid #333;
      text-transform: uppercase;
    }

    .price {
      position: absolute;
      bottom: 15px;
      right: 15px;
      background: rgba(255,87,51,0.95);
      backdrop-filter: blur(10px);
      color: #fff;
      padding: 10px 18px;
      border-radius: 25px;
      font-size: 0.8rem;
      font-weight: bold;
      box-shadow: 0 4px 15px rgba(255,87,51,0.4);
      z-index: 10;
      border: 1px solid rgba(255,255,255,0.2);
    }

    /* ==================== CONTENT ==================== */
    .event-content {
      padding: 25px;
      background: #0a0a0a;
      position: relative;
      z-index: 2;
    }

    .event-content h3 {
      font-size: 1.5rem;
      color: #fff;
      margin-bottom: 12px;
      transition: color 0.3s;
    }

    .event-card:hover .event-content h3 {
      color: #ff5733;
    }

    .location {
      color: #ff5733;
      font-size: 0.95rem;
      margin-bottom: 12px;
      display: flex;
      align-items: center;
      font-weight: 600;
    }

    .location::before {
      content: '📍';
      margin-right: 8px;
    }

    .detail {
      color: #999;
      font-size: 0.9rem;
      line-height: 1.7;
      margin-top: 8px;
    }

    /* ==================== FOOTER ==================== */
    .event-footer {
      padding: 15px 25px;
      background: rgba(255,87,51,0.05);
      border-top: 1px solid #222;
      color: #999;
      font-size: 0.85rem;
      text-align: center;
      font-weight: 600;
    }

    /* ==================== EMPTY STATE ==================== */
    .text-center {
      text-align: center;
      color: #666;
      font-size: 1.2rem;
      padding: 60px 20px;
      animation: fadeInUp 1s ease;
    }

    /* ==================== ANIMATIONS ==================== */
    @keyframes fadeInUp {
      from {
        opacity: 0;
        transform: translateY(30px);
      }
      to {
        opacity: 1;
        transform: translateY(0);
      }
    }

    @keyframes slideIn {
      from {
        opacity: 0;
        transform: translateX(-50px);
      }
      to {
        opacity: 1;
        transform: translateX(0);
      }
    }

    /* ==================== BACK TO TOP ==================== */
    .fab {
      position: fixed;
      bottom: 30px;
      right: 30px;
      width: 50px;
      height: 50px;
      background: #111;
      border: 1px solid #333;
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
      cursor: pointer;
      opacity: 0;
      transition: all 0.3s ease;
      z-index: 1000;
    }

    .fab.show {
      opacity: 1;
    }

    .fab:hover {
      background: #ff5733;
      border-color: #ff5733;
      transform: translateY(-5px);
      box-shadow: 0 8px 20px rgba(255,87,51,0.4);
    }

    .fab-icon {
      color: white;
      font-size: 24px;
      font-weight: bold;
    }

    /* ==================== RESPONSIVE ==================== */
    @media (max-width: 768px) {
      .hero-content h1 {
        font-size: 2.5rem;
      }

      .hero-content p {
        font-size: 1.1rem;
      }

      .container h2,
      .video-section h2 {
        font-size: 2rem;
      }

      .event-grid {
        grid-template-columns: 1fr;
      }

      .video-section {
        padding: 40px 20px;
      }
    }
  </style>
</head>
<body>

<main>
  <!-- Hero Section -->
  <section class="hero" id="hero">
    <div class="hero-content">
      <h1>YJ Creating</h1>
      <p>มาเรียนรู้แบบสนุก สร้างผลงาน และเติมประสบการณ์จริง</p>
    </div>
  </section>

  <!-- Video Section -->
  <section class="video-section">
    <h2>🎬 วิดีโอแนะนำ</h2>
    <div class="video-container">
      <div class="video-wrapper">
        <iframe 
          src="https://www.youtube.com/embed/s6vTiRaMiwg?si=GxiNzck_fMYTWNeP" 
          title="YJ Creating Video" 
          allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" 
          allowfullscreen>
        </iframe>
      </div>
    </div>
  </section>

  <!-- Event Section -->
  <section class="container">
    <h2>📅 Event</h2>
    <?php
    $query = mysqli_query($conn, "SELECT * FROM event 
                                  WHERE E_EndDate >= NOW() 
                                    AND status='approved'
                                  ORDER BY E_StartDate ASC 
                                  LIMIT 6");

    if ($query && mysqli_num_rows($query) > 0) {
      echo '<div class="event-grid">';
      while ($row = mysqli_fetch_assoc($query)) {
        $imgPath = getImagePath($row['E_Image']);
        $title = htmlspecialchars($row['E_Title']);
        $location = htmlspecialchars($row['E_Location']);
        $detail = $row['E_Detail'] ?: "ไม่มีรายละเอียด";
        $shortDetail = mb_strimwidth($detail, 0, 100, "...");
        $startDate = date("d M", strtotime($row['E_StartDate']));
        $endDate = date("d M", strtotime($row['E_EndDate']));
    ?>
        <div class="event-card">
          <div class="event-img-box">
            <img src="<?= $imgPath ?>" alt="<?= $title ?>" class="event-img">
            <span class="ribbon">ใหม่</span>
            <span class="tag">กิจกรรม</span>
            <span class="price"><?= $startDate ?> - <?= $endDate ?></span>
          </div>
          <div class="event-content">
            <h3><?= $title ?></h3>
            <p class="location"><?= $location ?></p>
            <p class="detail"><?= $shortDetail ?></p>
          </div>
          <div class="event-footer">
            Post by : YJ Creating
          </div>
        </div>
    <?php
      }
      echo '</div>';
    } else {
      echo '<p class="text-center">⏳ รอ Owner อนุมัติ หรือยังไม่มีอีเว้นท์</p>';
    }
    ?>
  </section>
</main>

<!-- Back to Top Button -->
<div class="fab" id="fab">
    <div class="fab-icon">↑</div>
</div>

<?php include __DIR__ . '/footer.php'; ?>

<script>
// Back to Top Button
const fab = document.getElementById('fab');
window.addEventListener('scroll', () => {
    if (window.pageYOffset > 300) {
        fab.classList.add('show');
    } else {
        fab.classList.remove('show');
    }
});

fab.addEventListener('click', () => {
    window.scrollTo({ top: 0, behavior: 'smooth' });
});

// Intersection Observer for scroll animations
const observerOptions = {
    threshold: 0.1,
    rootMargin: '0px 0px -50px 0px'
};

const observer = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
        if (entry.isIntersecting) {
            entry.target.style.animation = 'cardFadeIn 0.6s ease forwards';
        }
    });
}, observerOptions);

document.querySelectorAll('.event-card').forEach(card => {
    observer.observe(card);
});
</script>

</body>
</html>