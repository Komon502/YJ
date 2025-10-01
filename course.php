<?php
include 'admin/db_connect.php';
$sql = "SELECT * FROM course ORDER BY CourseName ASC";
$result = mysqli_query($conn, $sql);
?>

<?php include 'navbar.php'; ?>

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
}

/* Hero Section */
.hero {
    min-height: 70vh;
    display: flex;
    align-items: center;
    justify-content: center;
    text-align: center;
    background: #000;
    position: relative;
    padding: 40px 20px;
    background-size: cover;
    background-position: center;
}

.hero::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: linear-gradient(135deg, rgba(0,0,0,0.8) 0%, rgba(20,0,0,0.9) 100%);
    z-index: 1;
}

.hero::after {
    content: '';
    position: absolute;
    width: 500px;
    height: 500px;
    background: radial-gradient(circle, rgba(255,87,51,0.15) 0%, transparent 70%);
    top: 20%;
    left: 10%;
    border-radius: 50%;
    filter: blur(80px);
    z-index: 1;
}

.hero-content {
    position: relative;
    z-index: 2;
}

.hero-content h1 {
    font-size: 4rem;
    color: #fff;
    margin-bottom: 20px;
    animation: fadeInUp 1s ease;
    text-shadow: 0 0 30px rgba(255,87,51,0.3);
}

.hero-content h1::first-letter {
    color: #ff5733;
}

.hero-content p {
    font-size: 1.3rem;
    color: #aaa;
    max-width: 600px;
    margin: 0 auto;
    animation: fadeInUp 1s ease 0.3s both;
}

/* Background Images */
.hero-bg1 { background-image: url('image/course-bg1.jpg'); }
.hero-bg2 { background-image: url('image/course-bg2.jpg'); }
.hero-bg3 { background-image: url('image/course-bg3.jpg'); }
.hero-bg { background-image: url('image/course-bg.jpg'); }

/* Courses Section */
.courses {
    max-width: 1400px;
    margin: 0 auto;
    padding: 100px 20px;
    background: #000;
}

.courses h2 {
    text-align: center;
    font-size: 3rem;
    color: #fff;
    margin-bottom: 60px;
    animation: fadeInUp 0.8s ease;
    position: relative;
    display: inline-block;
    width: 100%;
}

.courses h2::after {
    content: '';
    position: absolute;
    bottom: -10px;
    left: 50%;
    transform: translateX(-50%);
    width: 100px;
    height: 3px;
    background: #ff5733;
}

.course-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(350px, 1fr));
    gap: 40px;
}

.course-card {
    background: #0a0a0a;
    border-radius: 20px;
    overflow: hidden;
    border: 1px solid #222;
    transition: all 0.3s ease;
    animation: fadeInUp 0.8s ease both;
}

.course-card:hover {
    transform: translateY(-10px);
    border-color: #ff5733;
    box-shadow: 0 15px 40px rgba(255,87,51,0.3);
}

.image-container {
    position: relative;
    width: 100%;
    height: 250px;
    overflow: hidden;
    background: #000;
}

.image-container img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.3s ease;
}

.course-card:hover .image-container img {
    transform: scale(1.1);
}

.status-badge {
    position: absolute;
    top: 15px;
    right: 15px;
    background: #ff5733;
    color: #fff;
    padding: 8px 20px;
    border-radius: 20px;
    font-size: 0.9rem;
    font-weight: bold;
    text-transform: uppercase;
    box-shadow: 0 4px 15px rgba(255,87,51,0.5);
}

.course-content {
    padding: 30px;
}

.course-content h3 {
    font-size: 1.8rem;
    color: #fff;
    margin-bottom: 15px;
}

.teacher {
    font-size: 1.1rem;
    color: #999;
    margin-bottom: 10px;
}

.fee {
    font-size: 1.2rem;
    color: #ff5733;
    font-weight: bold;
    margin-bottom: 15px;
}

.course-content p {
    font-size: 1rem;
    line-height: 1.8;
    color: #999;
}

/* Loading State */
.loading {
    text-align: center;
    padding: 100px 20px;
    font-size: 1.5rem;
    color: #ff5733;
}

/* Empty State */
.empty-state {
    text-align: center;
    padding: 100px 20px;
}

.empty-state h3 {
    font-size: 2rem;
    color: #fff;
    margin-bottom: 20px;
}

.empty-state p {
    font-size: 1.2rem;
    color: #666;
}

/* Animations */
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

/* Back to Top Button */
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

/* Responsive */
@media (max-width: 768px) {
    .hero-content h1 {
        font-size: 2.5rem;
    }

    .hero-content p {
        font-size: 1.1rem;
    }

    .courses h2 {
        font-size: 2rem;
    }

    .course-grid {
        grid-template-columns: 1fr;
    }
}

/* Stagger Animation for Cards */
.course-card:nth-child(1) { animation-delay: 0.1s; }
.course-card:nth-child(2) { animation-delay: 0.2s; }
.course-card:nth-child(3) { animation-delay: 0.3s; }
.course-card:nth-child(4) { animation-delay: 0.4s; }
.course-card:nth-child(5) { animation-delay: 0.5s; }
.course-card:nth-child(6) { animation-delay: 0.6s; }
</style>

<main>
  <!-- Hero Section -->
  <section class="hero">
    <div class="hero-content">
      <h1>Our Courses</h1>
      <p>เลือกคอร์สเรียนสนุก ๆ ที่จะช่วยเสริมทักษะ และสร้างผลงานใหม่</p>
    </div>
  </section>

  <!-- Courses Section -->
  <section class="courses">
    <h2>คอร์สเรียนที่เปิดรับสมัคร</h2>
    
    <?php if (mysqli_num_rows($result) > 0) { ?>
      <div class="course-grid">
        <?php while ($row = mysqli_fetch_assoc($result)) { ?>
          <div class="course-card">
            <div class="image-container">
              <img src="uploads/<?= htmlspecialchars($row['Image']) ?>" 
                   alt="<?= htmlspecialchars($row['CourseName']) ?>"
                   onerror="this.src='image/placeholder.jpg'">
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
    <?php } else { ?>
      <div class="empty-state">
        <h3>ยังไม่มีคอร์สเรียน</h3>
        <p>กำลังเตรียมคอร์สเรียนใหม่ๆ ให้ท่านเร็วๆ นี้</p>
      </div>
    <?php } ?>
  </section>
</main>

<!-- Back to Top Button -->
<div class="fab" id="fab">
    <div class="fab-icon">↑</div>
</div>

<?php include 'footer.php'; ?>

<script>
// Random Background
const hero = document.querySelector(".hero");
const bgClasses = ["hero-bg1", "hero-bg2", "hero-bg3", "hero-bg"];
const randomBg = bgClasses[Math.floor(Math.random() * bgClasses.length)];
hero.classList.add(randomBg);

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

// Add smooth scroll behavior
document.querySelectorAll('a[href^="#"]').forEach(anchor => {
    anchor.addEventListener('click', function (e) {
        e.preventDefault();
        const target = document.querySelector(this.getAttribute('href'));
        if (target) {
            target.scrollIntoView({ behavior: 'smooth' });
        }
    });
});
</script>