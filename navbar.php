<header>
  <div class="navbar">
    <div class="logo">
      <a href="index.php">
        <img src="image/YJ.png" alt="YJ Logo">
      </a>
    </div>

    <!-- Hamburger -->
    <div class="hamburger" onclick="toggleMenu()">
      <span></span>
      <span></span>
      <span></span>
    </div>

    <!-- เมนู -->
    <nav class="menu" id="menu">
      <a href="index.php">HOME</a>
      <a href="about.php">ABOUT</a>
      <a href="course.php">COURSE</a>
      <a href="contact.php">CONTACT</a>
    </nav>
  </div>
</header>

<script>
  function toggleMenu() {
    document.getElementById("menu").classList.toggle("active");
    document.querySelector(".hamburger").classList.toggle("active");
  }
</script>
