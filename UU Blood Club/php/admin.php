<?php
session_start();
if (isset($_SESSION['admin_logged_in'])) {
    header("Location: dashboard.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Login - UUBC</title>

  <link rel="icon" type="image/x-icon" href="../images/logo.png" />

  <!-- Fonts & Icons -->
  <link href="https://fonts.googleapis.com/css2?family=JetBrains+Mono,wght@1,400&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">

  <!-- External CSS -->
  <link rel="stylesheet" href="../css/navbar.css">
  <link rel="stylesheet" href="../css/admin.css">
</head>

<body>w

  <!-- ✅ Navigation Bar -->
  <nav class="navigation_bar">
    <div class="small-nav">
      <div class="header-logo-container">
        <div class="small-icon-container flex">
          <img src="../images/logo1.png" alt="UUBC Logo" class="small-logo logo">
          <section class="nav-heading">
            <h1>Uttara University Blood Club</h1>
            <p>Join us in saving lives — every drop counts!</p>
          </section>
        </div>
        <i class="fa-solid fa-bars expand-btn" id="expand-btn"></i>
      </div>

      <ul id="nav-menu">
        <li><a href="../index.html">|Home</a></li>
        <li><a href="../about_us.html">|About Us</a></li>
        <li><a href="../advisors.html">|Advisors</a></li>
        <li><a href="../sponsors.html">|Sponsors</a></li>
        <li><a href="../find_donor.html">|Need a Donor</a></li>
        <li><a href="../be_donor.html">|Be a Donor</a></li>
        <li><a href="../membership.html">|Membership</a></li>
        <li><a href="user.php">|User</a></li>
        <li><a href="admin.php" class="active">|Admin</a></li>
      </ul>
    </div>

    <ul id="large-nav" class="large-nav">
      <li><img src="../images/logo1.png" alt="UUBC Logo" class="logo"></li>
      <li><a href="../index.html">|Home</a></li>
      <li><a href="../about_us.html">|About Us</a></li>
      <li><a href="../advisors.html">|Advisors</a></li>
      <li><a href="../sponsors.html">|Sponsors</a></li>
      <li><a href="../find_donor.html">|Need a Donor</a></li>
      <li><a href="../be_donor.html">|Be a Donor</a></li>
      <li><a href="../membership.html">|Membership</a></li>
      <li><a href="user.php">|User</a></li>
      <li><a href="admin.php" class="active">|Admin</a></li>
    </ul>
  </nav>

  <!-- ✅ Admin Login Section -->
  <section>
    <div class="admin-container">
      <h2><i class="fa-solid fa-user-shield"></i> Admin Login</h2>

      <form id="adminForm" class="admin-form" method="POST" action="login.php">
    <label>UserID:</label>
    <input type="email" name="email" placeholder="admin user id" required>

    <label>Password:</label>
    <input type="password" name="password" placeholder="Enter password" required>

    <button type="submit">Login</button>
</form>


      <p id="errorMessage" style="color:red; display:none; margin-top:10px;"></p>
    </div>
  </section>

  <!-- ✅ Footer -->
  <footer class="footer">
    <div class="footer-content">
      <p>&copy; 2025 | Uttara University Blood Club</p>
      <p>Developed by: <strong>Team Metrorail</strong></p>

      <h2>Our Team</h2>
      <div class="team-profiles">
        <a href="https://github.com/Ctrl-LNB/" title="Lutfun Nahar Barsha" target="_blank"><img src="https://github.com/Ctrl-LNB.png"></a>
        <a href="https://github.com/Mrh-Script/" title="Md. Riad Hasan" target="_blank"><img src="https://github.com/Mrh-Script.png"></a>
        <a href="https://github.com/kowser-mahmood" title="Md. Kowser Mahmud" target="_blank"><img src="https://github.com/kowser-mahmood.png"></a>
        <a href="https://github.com/tanzimulahsan-10zim" title="Md. Tanzimul Ahsan" target="_blank"><img src="https://github.com/tanzimulahsan-10zim.png"></a>
        <a href="https://github.com/Jowel-Rana-JR-99" title="Md. Juwel Rana" target="_blank"><img src="https://github.com/Jowel-Rana-JR-99.png"></a>
      </div>

      <h2>Contact Us (UU)</h2>
      <div class="social-icons">
        <a href="https://www.facebook.com/UttaraUniversity" target="_blank"><i class="fa-brands fa-facebook-f"></i></a>
        <a href="https://x.com/Uttara_Varsity" target="_blank"><i class="fa-brands fa-x-twitter"></i></a>
        <a href="https://www.youtube.com/c/UttaraUniversityofficial" target="_blank"><i class="fa-brands fa-youtube"></i></a>
      </div>
    </div>
  </footer>


  <script src="../js/main.js"></script>
</body>
</html>
