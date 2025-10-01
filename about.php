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
    overflow-x: hidden;
}

/* Hero Section */
.hero {
    min-height: 100vh;
    display: flex;
    align-items: center;
    justify-content: center;
    text-align: center;
    background: #000;
    position: relative;
    padding: 20px;
}

.hero::before {
    content: '';
    position: absolute;
    width: 500px;
    height: 500px;
    background: radial-gradient(circle, rgba(255,87,51,0.1) 0%, transparent 70%);
    top: 10%;
    right: 10%;
    border-radius: 50%;
    filter: blur(80px);
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
    line-height: 1.8;
    animation: fadeInUp 1s ease 0.3s both;
}

.scroll-indicator {
    position: absolute;
    bottom: 40px;
    left: 50%;
    transform: translateX(-50%);
    cursor: pointer;
    animation: bounce 2s infinite;
    text-align: center;
}

.scroll-indicator::before {
    content: '▼';
    display: block;
    font-size: 2rem;
    color: #ff5733;
    margin-bottom: 8px;
}

.scroll-indicator span {
    color: #555;
    font-size: 0.85rem;
    letter-spacing: 2px;
}

/* About Section */
.about-section {
    max-width: 1200px;
    margin: 0 auto;
    padding: 100px 20px;
    background: #000;
}

.about-section h2 {
    text-align: center;
    font-size: 3rem;
    color: #fff;
    margin-bottom: 60px;
    position: relative;
    display: inline-block;
    width: 100%;
}

.about-section h2::after {
    content: '';
    position: absolute;
    bottom: -10px;
    left: 50%;
    transform: translateX(-50%);
    width: 100px;
    height: 3px;
    background: #ff5733;
}

.about-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 60px;
    align-items: center;
    margin-bottom: 80px;
}

.about-text p {
    font-size: 1.2rem;
    line-height: 2;
    color: #999;
    margin-bottom: 20px;
}

.highlight {
    color: #ff5733;
    font-weight: bold;
}

.image-wrapper {
    border-radius: 20px;
    overflow: hidden;
    box-shadow: 0 10px 40px rgba(0,0,0,0.5);
    border: 1px solid #222;
}

.image-wrapper img {
    width: 100%;
    display: block;
    transition: transform 0.3s ease;
}

.image-wrapper:hover {
    border-color: #ff5733;
}

.image-wrapper:hover img {
    transform: scale(1.05);
}

/* Stats Section */
.stats-section {
    background: #0a0a0a;
    padding: 80px 20px;
    text-align: center;
    border-top: 1px solid #111;
    border-bottom: 1px solid #111;
}

.section-title {
    font-size: 2.5rem;
    color: #fff;
    margin-bottom: 50px;
    position: relative;
    display: inline-block;
}

.section-title::after {
    content: '';
    position: absolute;
    bottom: -10px;
    left: 50%;
    transform: translateX(-50%);
    width: 80px;
    height: 3px;
    background: #ff5733;
}

.stats-grid {
    max-width: 1000px;
    margin: 0 auto;
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 40px;
}

.stat-card {
    background: #000;
    padding: 40px 20px;
    border-radius: 15px;
    border: 1px solid #222;
    transition: all 0.3s ease;
}

.stat-card:hover {
    transform: translateY(-10px);
    border-color: #ff5733;
    box-shadow: 0 15px 40px rgba(255,87,51,0.2);
}

.stat-icon {
    font-size: 3rem;
    margin-bottom: 15px;
    filter: grayscale(0.5);
}

.stat-card:hover .stat-icon {
    filter: grayscale(0);
}

.stat-number {
    font-size: 3rem;
    color: #ff5733;
    font-weight: bold;
    margin-bottom: 10px;
}

.stat-label {
    font-size: 1.1rem;
    color: #666;
    text-transform: uppercase;
}

/* Team Section */
.team-section {
    max-width: 600px;
    margin: 0 auto;
    padding: 100px 20px;
    text-align: center;
}

.team-card {
    background: #0a0a0a;
    padding: 50px 30px;
    border-radius: 20px;
    border: 1px solid #222;
    transition: all 0.3s ease;
}

.team-card:hover {
    transform: translateY(-10px);
    border-color: #ff5733;
    box-shadow: 0 15px 40px rgba(255,87,51,0.2);
}

.team-image-wrapper {
    width: 180px;
    height: 180px;
    margin: 0 auto 25px;
    border-radius: 50%;
    border: 3px solid #222;
    overflow: hidden;
    box-shadow: 0 10px 30px rgba(0,0,0,0.5);
    transition: border-color 0.3s ease;
}

.team-card:hover .team-image-wrapper {
    border-color: #ff5733;
}

.team-image-wrapper img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.team-info h3 {
    font-size: 1.5rem;
    color: #fff;
    margin-bottom: 10px;
}

.role {
    font-size: 1.1rem;
    color: #666;
    margin-bottom: 20px;
}

.contact {
    display: inline-flex;
    align-items: center;
    gap: 10px;
    padding: 12px 30px;
    background: #111;
    color: #fff;
    border: 1px solid #333;
    border-radius: 25px;
    text-decoration: none;
    transition: all 0.3s ease;
}

.contact:hover {
    background: #ff5733;
    border-color: #ff5733;
    transform: translateY(-3px);
    box-shadow: 0 8px 20px rgba(255,87,51,0.3);
}

/* Back to Top */
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
    box-shadow: 0 8px 20px rgba(255,87,51,0.3);
}

.fab-icon {
    color: white;
    font-size: 24px;
    font-weight: bold;
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

@keyframes bounce {
    0%, 100% { 
        transform: translateX(-50%) translateY(0); 
    }
    50% { 
        transform: translateX(-50%) translateY(10px); 
    }
}

/* Responsive */
@media (max-width: 768px) {
    .hero-content h1 {
        font-size: 2.5rem;
    }

    .about-grid {
        grid-template-columns: 1fr;
        gap: 40px;
    }

    .stats-grid {
        grid-template-columns: 1fr;
    }
}
</style>

<main>
    <!-- Hero Section -->
    <section class="hero">
        <div class="hero-content">
            <h1>YJ CREATING</h1>
            <p>พื้นที่สร้างสรรค์สำหรับเด็กและเยาวชน<br>เรียนรู้แบบสนุก สร้างผลงานจริง</p>
        </div>
        <div class="scroll-indicator" onclick="document.querySelector('.about-section').scrollIntoView({behavior: 'smooth'})">
            <span>เลื่อนลง</span>
        </div>
    </section>

    <!-- About Section -->
    <section class="about-section">
        <h2>เกี่ยวกับเรา</h2>
        <div class="about-grid">
            <div class="about-text">
                <p>
                    YJ Creating ก่อตั้งขึ้นเพื่อสร้างพื้นที่ให้เด็กและเยาวชนได้เรียนรู้แบบ 
                    <span class="highlight">สนุก</span>
                </p>
                <p>
                    พร้อมสร้างผลงานที่จับต้องได้จริง และเสริมทักษะให้ก้าวสู่ Creator มืออาชีพ
                </p>
                <p>
                    เราเชื่อว่าทุกคนมีความคิดสร้างสรรค์ในแบบของตัวเอง และภารกิจของเราคือการช่วยให้เด็ก ๆ ได้ค้นพบพลังนั้น
                </p>
            </div>
            <div class="about-image">
                <div class="image-wrapper">
                    <img src="image/YJ1.png" alt="YJ Creating">
                </div>
            </div>
        </div>
    </section>

    <!-- Stats Section -->
    <section class="stats-section">
        <h2 class="section-title">ความสำเร็จของเรา</h2>
        <div class="stats-grid">
            <div class="stat-card">
                <div class="stat-icon">🎯</div>
                <div class="stat-number" data-target="100">0</div>
                <div class="stat-label">นักเรียน</div>
            </div>
            <div class="stat-card">
                <div class="stat-icon">🏆</div>
                <div class="stat-number" data-target="50">0</div>
                <div class="stat-label">ผลงาน</div>
            </div>
            <div class="stat-card">
                <div class="stat-icon">⭐</div>
                <div class="stat-number" data-target="5">0</div>
                <div class="stat-label">ปีประสบการณ์</div>
            </div>
        </div>
    </section>

    <!-- Team Section -->
    <section class="team-section">
        <h2 class="section-title">ผู้บริหาร</h2>
        <div class="team-card">
            <div class="team-image-wrapper">
                <img src="image/owner.jpg" alt="Founder">
            </div>
            <div class="team-info">
                <h3>คุณปฏิภาณ เตียเจริญวรรธน์ (ฌิ)</h3>
                <div class="role">YJ Founder & CEO</div>
                <a href="tel:0623246561" class="contact">
                    <span>📞</span>
                    <span>062-324-6561</span>
                </a>
            </div>
        </div>
    </section>
</main>

<!-- Back to Top Button -->
<div class="fab" id="fab">
    <div class="fab-icon">↑</div>
</div>

<?php include 'footer.php'; ?>

<script>
// Counter Animation
function animateCounter(element) {
    const target = parseInt(element.getAttribute('data-target'));
    const duration = 2000;
    const step = target / (duration / 16);
    let current = 0;
    
    const timer = setInterval(() => {
        current += step;
        if (current >= target) {
            element.textContent = target + '+';
            clearInterval(timer);
        } else {
            element.textContent = Math.floor(current);
        }
    }, 16);
}

// Trigger counters on scroll
const observer = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
        if (entry.isIntersecting) {
            const counter = entry.target.querySelector('.stat-number');
            if (counter && !counter.classList.contains('counted')) {
                counter.classList.add('counted');
                animateCounter(counter);
            }
        }
    });
}, { threshold: 0.5 });

document.querySelectorAll('.stat-card').forEach(card => {
    observer.observe(card);
});

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
</script>