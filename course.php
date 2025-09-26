<?php
include 'admin/db_connect.php';
$sql = "SELECT * FROM course ORDER BY CourseName ASC";
$result = mysqli_query($conn, $sql);
?>

<?php include 'navbar.php'; ?>
<link rel="stylesheet" href="public/style.css">
<link rel="stylesheet" href="public/course_style.css">

<section class="hero">
  <div class="hero-content">
    <h1>Our Courses</h1>
    <p>เลือกคอร์สเรียนสนุก ๆ ที่จะช่วยเสริมทักษะ และสร้างผลงานใหม่ ✨</p>
  </div>
</section>

<section class="courses">
  <h2>คอร์สเรียนที่เปิดรับสมัคร</h2>
  <div class="course-grid">
    <?php while ($row = mysqli_fetch_assoc($result)) { ?>
      <div class="course-card">
        <div class="image-container">
          <img src="uploads/<?= htmlspecialchars($row['Image']) ?>" alt="<?= htmlspecialchars($row['CourseName']) ?>">
          <div class="status-badge"><?= htmlspecialchars($row['Category']) ?></div>
        </div>
        <div class="course-content">
          <h3><?= htmlspecialchars($row['CourseName']) ?></h3>
          <p class="teacher">👨‍🏫 <?= htmlspecialchars($row['Teacher']) ?></p>
          <p class="fee">💰 <?= number_format($row['Fee'], 0) ?> บาท / <?= htmlspecialchars($row['Duration']) ?></p>
          <p><?= nl2br(htmlspecialchars($row['Description'])) ?></p>
        </div>
      </div>
    <?php } ?>
  </div>
</section>

<?php include 'footer.php'; ?>
