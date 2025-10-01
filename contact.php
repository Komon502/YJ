<?php include 'navbar.php'; ?>
<link rel="stylesheet" href="public/style.css">
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

/* ==================== HERO SECTION ==================== */
.hero {
    min-height: 60vh;
    display: flex;
    align-items: center;
    justify-content: center;
    text-align: center;
    background: #000;
    position: relative;
    padding: 40px 20px;
    overflow: hidden;
}

.hero::before {
    content: '';
    position: absolute;
    width: 500px;
    height: 500px;
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
    animation: fadeInUp 1s ease;
}

.hero-content h1 {
    font-size: 4rem;
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
    max-width: 600px;
    margin: 0 auto;
}

/* ==================== CONTACT SECTION ==================== */
.contact-section {
    max-width: 900px;
    margin: 0 auto;
    padding: 100px 20px;
}

.contact-section h2 {
    text-align: center;
    font-size: 3rem;
    color: #fff;
    margin-bottom: 60px;
    position: relative;
    display: inline-block;
    width: 100%;
    animation: slideIn 0.8s ease;
}

.contact-section h2::after {
    content: '';
    position: absolute;
    bottom: -10px;
    left: 50%;
    transform: translateX(-50%);
    width: 100px;
    height: 3px;
    background: #ff5733;
}

.social-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 40px;
    margin-top: 50px;
}

.social-link {
    text-decoration: none;
    color: inherit;
    opacity: 0;
    transform: translateY(30px);
    animation: cardFadeIn 0.6s ease forwards;
}

.social-link:nth-child(1) { animation-delay: 0.1s; }
.social-link:nth-child(2) { animation-delay: 0.2s; }
.social-link:nth-child(3) { animation-delay: 0.3s; }

.social-card {
    background: #0a0a0a;
    border: 1px solid #222;
    border-radius: 20px;
    padding: 40px 20px;
    text-align: center;
    transition: all 0.4s ease;
    position: relative;
    overflow: hidden;
}

.social-card::before {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(90deg, transparent, rgba(255,87,51,0.1), transparent);
    transition: left 0.6s;
}

.social-card:hover::before {
    left: 100%;
}

.social-card:hover {
    transform: translateY(-10px);
    border-color: #ff5733;
    box-shadow: 0 15px 40px rgba(255,87,51,0.3);
}

.social-icon {
    width: 100px;
    height: 100px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 20px;
    background: #111;
    border: 2px solid #222;
    transition: all 0.4s ease;
    position: relative;
}

.social-icon i,
.social-icon img {
    font-size: 3rem;
    max-width: 50px;
    max-height: 50px;
    transition: all 0.3s ease;
}

/* Facebook */
.facebook .social-icon {
    background: linear-gradient(135deg, #111 0%, #1a1a1a 100%);
}

.facebook:hover .social-icon {
    background: linear-gradient(135deg, #1877f2 0%, #0d5dbf 100%);
    border-color: #1877f2;
    box-shadow: 0 0 30px rgba(24,119,242,0.5);
}

.facebook:hover .social-icon i {
    color: #fff;
    transform: scale(1.1);
}

/* Line */
.line .social-icon {
    background: linear-gradient(135deg, #111 0%, #1a1a1a 100%);
}

.line:hover .social-icon {
    background: linear-gradient(135deg, #06C755 0%, #05a847 100%);
    border-color: #06C755;
    box-shadow: 0 0 30px rgba(6,199,85,0.5);
}

.line:hover .social-icon img {
    filter: brightness(0) invert(1);
    transform: scale(1.1);
}

/* TikTok */
.tiktok .social-icon {
    background: linear-gradient(135deg, #111 0%, #1a1a1a 100%);
}

.tiktok:hover .social-icon {
    background: linear-gradient(135deg, #000 0%, #333 100%);
    border-color: #ff0050;
    box-shadow: 0 0 30px rgba(255,0,80,0.5);
}

.tiktok:hover .social-icon img {
    filter: brightness(0) invert(1);
    transform: scale(1.1);
}

.social-name {
    font-size: 1.3rem;
    font-weight: 600;
    color: #fff;
    margin-top: 10px;
    transition: color 0.3s;
}

.social-card:hover .social-name {
    color: #ff5733;
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

@keyframes cardFadeIn {
    to {
        opacity: 1;
        transform: translateY(0);
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

    .contact-section h2 {
        font-size: 2rem;
    }

    .social-grid {
        grid-template-columns: 1fr;
        gap: 30px;
    }
}
</style>

<main>
  <!-- HERO -->
  <section class="hero">
    <div class="hero-content">
      <h1>Contact Us</h1>
      <p>สนใจสมัครเรียนที่ YJ ติดต่อเราได้ผ่านช่องทางโซเชียล</p>
    </div>
  </section>

  <!-- CONTACT -->
  <section class="contact-section">
    <h2>ช่องทางการติดต่อ</h2>
    
    <div class="social-grid">
      
      <!-- Facebook -->
      <a href="https://www.facebook.com/YJcreating" target="_blank" class="social-link facebook">
        <div class="social-card">
          <div class="social-icon">
            <svg width="50" height="50" viewBox="0 0 24 24" fill="#1877f2">
              <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
            </svg>
          </div>
          <p class="social-name">Facebook</p>
        </div>
      </a>

      <!-- Line -->
      <a href="https://line.me/R/ti/p/@315wncfs?ts=09181649&oat_content=url" target="_blank" class="social-link line">
        <div class="social-card">
          <div class="social-icon">
            <img src="https://upload.wikimedia.org/wikipedia/commons/4/41/LINE_logo.svg" alt="Line Logo">
          </div>
          <p class="social-name">Line</p>
        </div>
      </a>

      <!-- TikTok -->
      <a href="https://www.tiktok.com/@yj.creating" target="_blank" class="social-link tiktok">
        <div class="social-card">
          <div class="social-icon">
            <img src="https://upload.wikimedia.org/wikipedia/en/a/a9/TikTok_logo.svg" alt="TikTok Logo">
          </div>
          <p class="social-name">TikTok</p>
        </div>
      </a>

    </div>
  </section>
</main>

<!-- Back to Top Button -->
<div class="fab" id="fab">
    <div class="fab-icon">↑</div>
</div>

<?php include 'footer.php'; ?>

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

// Add hover sound effect (optional)
document.querySelectorAll('.social-card').forEach(card => {
    card.addEventListener('mouseenter', () => {
        card.style.transition = 'all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275)';
    });
});
</script>