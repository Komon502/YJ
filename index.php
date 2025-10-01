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
  <link rel="stylesheet" href="public/style.css">
  <link rel="stylesheet" href="public/index_style.css">
</head>
<body>

<main>
  <!-- Hero Section -->
  <section class="hero" id="hero">
    <div class="hero-content">
      <h1>YJ Creating</h1>
      <p>▶️ มาเรียนรู้แบบสนุก ๆ สร้างผลงาน และเติมประสบการณ์จริง ✨</p>
      <a href="course.php" class="cta-btn">ดูคอร์ส</a>
    </div>
  </section>

  <!-- Event Section -->
  <section class="container my-5">
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
            จัดโดย: YJ Creating
          </div>
        </div>
    <?php
      }
      echo '</div>';
    } else {
      echo '<p class="text-center text-muted">⏳ รอ Owner อนุมัติ หรือยังไม่มีอีเว้นท์</p>';
    }
    ?>
  </section>
</main>

<?php include __DIR__ . '/footer.php'; ?>

<!-- Random Background Script -->
<script>
document.addEventListener('DOMContentLoaded', function() {
  const hero = document.getElementById('hero');
  if (hero) {
    const bgClasses = ['hero-bg1', 'hero-bg2', 'hero-bg3'];
    const randomBg = bgClasses[Math.floor(Math.random() * bgClasses.length)];
    hero.classList.add(randomBg);
  }
});
</script>

</body>
</html>