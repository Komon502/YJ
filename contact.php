<?php include 'navbar.php'; ?>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
<link rel="stylesheet" href="public/style.css">
<link rel="stylesheet" href="public/contact_style.css">

<style>
  .social-icon {
    width: 80px;
    height: 80px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 10px;
    background: #f8f9fa;
    box-shadow: 0 4px 10px rgba(0,0,0,0.15);
    transition: all 0.3s ease;
  }

  .social-icon:hover {
    transform: translateY(-5px);
    box-shadow: 0 6px 15px rgba(0,0,0,0.25);
  }

  .social-icon i,
  .social-icon img {
    font-size: 2rem;
    max-width: 40px;
    max-height: 40px;
  }

  /* สีเฉพาะแบรนด์ */
  .facebook:hover { background: #1877f2; }
  .facebook:hover i { color: #fff; }

  .line:hover { background: #06C755; }
  .line:hover img { filter: brightness(0) invert(1); }

  .tiktok:hover { background: #000; }
  .tiktok:hover img { filter: brightness(0) invert(1); }
</style>

<main>
  <!-- HERO -->
  <section class="hero text-center py-5 bg-dark text-white">
    <div class="hero-content">
      <h1>Contact Us</h1>
      <p>สนใจสมัครเรียนที่ YJ ติดต่อเราได้ผ่านช่องทางโซเชียล ✨</p>
    </div>
  </section>

  <!-- CONTACT -->
  <section class="contact-section container text-center my-5">
    <h2 class="mb-4">ช่องทางการติดต่อ</h2>
    <div class="row justify-content-center g-4">
      
      <!-- Facebook -->
      <div class="col-4 col-md-2">
        <a href="https://www.facebook.com/YJcreating" target="_blank" class="text-decoration-none">
          <div class="social-icon facebook">
            <i class="bi bi-facebook text-primary"></i>
          </div>
          <p class="mt-2 fw-semibold">Facebook</p>
        </a>
      </div>

      <!-- Line -->
      <div class="col-4 col-md-2">
        <a href="https://line.me/R/ti/p/@315wncfs?ts=09181649&oat_content=url" target="_blank" class="text-decoration-none">
          <div class="social-icon line">
            <img src="https://upload.wikimedia.org/wikipedia/commons/4/41/LINE_logo.svg" alt="Line Logo">
          </div>
          <p class="mt-2 fw-semibold">Line</p>
        </a>
      </div>

      <!-- TikTok -->
      <div class="col-4 col-md-2">
        <a href="https://www.tiktok.com/@yj.creating" target="_blank" class="text-decoration-none">
          <div class="social-icon tiktok">
            <img src="https://upload.wikimedia.org/wikipedia/en/a/a9/TikTok_logo.svg" alt="TikTok Logo">
          </div>
          <p class="mt-2 fw-semibold">TikTok</p>
        </a>
      </div>

    </div>
  </section>
</main>

<?php include 'footer.php'; ?>
