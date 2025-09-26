<?php
// เชื่อมต่อส่วน navbar และฐานข้อมูล
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
<!-- ================= CSS ================= -->
<link rel="stylesheet" href="public/style.css">
<link rel="stylesheet" href="public/index_style.css">

<!-- ================= HERO ================= -->
<section class="hero">
  <div class="hero-content">
    <h1>YJ Creating</h1>
    <p>▶️ มาเรียนรู้แบบสนุก ๆ สร้างผลงาน และเติมประสบการณ์จริง ✨</p>
  </div>
</section>

<!-- ================= EVENT SECTION ================= -->
<section class="container my-5">
  <h2 class="text-center mb-4 text-warning">📅 Event</h2>
  <?php
  $query = mysqli_query($conn, "SELECT * FROM event 
                                WHERE E_EndDate >= NOW() 
                                  AND status='approved'
                                ORDER BY E_StartDate ASC 
                                LIMIT 6");

  if (mysqli_num_rows($query) > 0) {
    echo '<div class="event-grid">';
    while ($row = mysqli_fetch_assoc($query)) {
      $imgPath = getImagePath($row['E_Image']);
  ?>
      <div class="event-card">
        <div class="event-img-box">
          <img src="<?= $imgPath ?>" alt="event-image" class="event-img">
          <span class="ribbon">ใหม่</span>
          <span class="tag">กิจกรรม</span>
          <span class="price">
            <?= date("d M", strtotime($row['E_StartDate'])) ?> -
            <?= date("d M", strtotime($row['E_EndDate'])) ?>
          </span>
        </div>
        <div class="event-content">
          <h3><?= htmlspecialchars($row['E_Title']) ?></h3>
          <p class="location"><?= htmlspecialchars($row['E_Location']) ?></p>
          <p class="detail">
            <?= mb_strimwidth($row['E_Detail'] ?: "ไม่มีรายละเอียด", 0, 60, "..."); ?>
          </p>
        </div>
        <div class="event-footer"></div>
      </div>
  <?php
    }
    echo '</div>';
  } else {
    echo "<p class='text-center text-muted'>⏳ รอ Owner อนุมัติ หรือยังไม่มีอีเว้นท์</p>";
  }
  ?>
</section>

<!-- ================= FOOTER ================= -->
<?php include __DIR__ . '/footer.php'; ?>
