<?php
include 'navbar.php';
include 'db_connect.php';
?>
<link rel="stylesheet" href="style.css">
<link rel="stylesheet" href="index_style.css">

<!-- HERO -->
<section class="hero">
  <div class="hero-content">
    <h1>YJ Creating</h1>
    <p>▶️ มาเรียนรู้แบบสนุก ๆ สร้างผลงาน และเติมประสบการณ์จริง ✨</p>
  </div>
</section>

<!-- EVENT SECTION -->
<section class="container my-5">
  <h2 class="text-center mb-4 text-warning">📅 Event</h2>

  <?php
  $query = mysqli_query($conn, "SELECT * FROM event ORDER BY E_StartDate DESC LIMIT 6");
  $count = mysqli_num_rows($query);

  if ($count > 0) {
    if ($count >= 3) {
      // ใช้ Swiper ถ้า event >= 3
      echo '<div class="swiper mySwiper"><div class="swiper-wrapper">';
      while ($row = mysqli_fetch_assoc($query)) {
  ?>
        <div class="swiper-slide">
          <div class="event-card">
            <!-- รูป -->
            <div class="event-img-box">
              <img src="./uploads/<?php echo $row['E_Image']; ?>"
                alt="event-image" class="event-img"
                onerror="this.src='image/no-image.png'">
              <span class="ribbon">ใหม่</span>
              <span class="tag">กิจกรรม</span>
              <span class="price">
                <?php echo date("d M", strtotime($row['E_StartDate'])); ?> -
                <?php echo date("d M", strtotime($row['E_EndDate'])); ?>
              </span>
            </div>

            <!-- เนื้อหา -->
            <div class="event-content">
              <h3><?php echo htmlspecialchars($row['E_Title']); ?></h3>
              <p class="location"><i class="fas fa-map-marker-alt"></i>
                <?php echo htmlspecialchars($row['E_Location']); ?>
              </p>
              <p class="detail">
                <?php
                $detail = !empty($row['E_Detail']) ? $row['E_Detail'] : "ไม่มีรายละเอียด";
                echo mb_strimwidth($detail, 0, 60, "...");
                ?>
              </p>
            </div>

            <!-- Footer -->
            <div class="event-footer">
              <a href="event_detail.php?id=<?php echo $row['EventID']; ?>"
                class="btn btn-warning btn-sm text-dark fw-bold rounded-pill px-3">
                ดูรายละเอียด
              </a>
            </div>
          </div>
        </div>
      <?php
      }
      echo '</div>
            <div class="swiper-pagination"></div>
            <div class="swiper-button-next"></div>
            <div class="swiper-button-prev"></div>
          </div>';
    } else {
      // ถ้า event < 3 ใช้ grid ธรรมดา
      echo '<div class="event-grid">';
      mysqli_data_seek($query, 0);
      while ($row = mysqli_fetch_assoc($query)) {
      ?>
        <div class="event-card">
          <div class="event-img-box">
            <img src="./uploads/<?php echo $row['E_Image']; ?>"
              alt="event-image" class="event-img"
              onerror="this.src='image/no-image.png'">
            <span class="ribbon">ใหม่</span>
            <span class="tag">กิจกรรม</span>
            <span class="price">
              <?php echo date("d M", strtotime($row['E_StartDate'])); ?> -
              <?php echo date("d M", strtotime($row['E_EndDate'])); ?>
            </span>
          </div>
          <div class="event-content">
            <h3><?php echo htmlspecialchars($row['E_Title']); ?></h3>
            <p class="location"><i class="fas fa-map-marker-alt"></i>
              <?php echo htmlspecialchars($row['E_Location']); ?>
            </p>
            <p class="detail">
              <?php
              $detail = !empty($row['E_Detail']) ? $row['E_Detail'] : "ไม่มีรายละเอียด";
              echo mb_strimwidth($detail, 0, 60, "...");
              ?>
            </p>
          </div>
          <div class="event-footer">
            <a href="event_detail.php?id=<?php echo $row['EventID']; ?>"
              class="btn btn-warning btn-sm text-dark fw-bold rounded-pill px-3">
              ดูรายละเอียด
            </a>
          </div>
        </div>
  <?php
      }
      echo '</div>';
    }
  } else {
    echo "<p class='text-center text-muted'>ยังไม่มีอีเว้นท์</p>";
  }
  ?>
</section>

<?php include 'footer.php'; ?>

<!-- Swiper -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

<script>
  var swiper = new Swiper(".mySwiper", {
    slidesPerView: 3,
    spaceBetween: 25,
    loop: true,
    autoplay: {
      delay: 4000,
      disableOnInteraction: false,
    },
    pagination: {
      el: ".swiper-pagination",
      clickable: true,
    },
    navigation: {
      nextEl: ".swiper-button-next",
      prevEl: ".swiper-button-prev",
    },
    breakpoints: {
      0: { slidesPerView: 1 },
      768: { slidesPerView: 2 },
      1200: { slidesPerView: 3 }
    }
  });
</script>
