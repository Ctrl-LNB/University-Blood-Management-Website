<?php
session_start();

if (!empty($_SESSION['USER'])) {
    header("Location: user_profile.php");
    exit;
}

if (!empty($_SESSION['LOGOUT_SUCCESS'])) {
    echo "You have logged out successfully.";
    unset($_SESSION['LOGOUT_SUCCESS']);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>User Login & Signup - UUBC</title>

  <link rel="icon" type="image/x-icon" href="images/logo.png" />

  <!-- Fonts & Icons -->
  <link href="https://fonts.googleapis.com/css2?family=JetBrains+Mono,wght@1,400&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">

  <!-- Existing Styles -->
  <link rel="stylesheet" href="../css/navbar.css">
  <link rel="stylesheet" href="../css/admin.css">

  <style>
    
    .tab-buttons {
      display: flex;
      justify-content: center;
      margin-bottom: 20px;
    }
    .tab-buttons button {
      padding: 10px 20px;
      border: 2px solid black;
      background: white;
      color: black;
      cursor: pointer;
      margin: 0 5px;
      border-radius: 5px;
    }
    .tab-buttons button.active {
      background: green;
    }
    .form-container {
      display: none;
    }
    .form-container.active {
      display: block;
    }
  </style>
</head>

<body>

  <!-- Navigation Bar (Copied Exactly) -->
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
        <li><a href="user.php" class="active">|User</a></li>
        <li><a href="admin.php">|Admin</a></li>
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
      <li><a href="user.php" class="active">|User</a></li>
      <li><a href="admin.php">|Admin</a></li>
    </ul>
  </nav>

  <!-- User Login/Signup -->
  <section>
    <div class="admin-container">
      <h2> User Login <i class="fa-solid fa-right-to-bracket"></i> & Signup <i class="fa-solid fa-user-plus"></i></h2>

      <div class="tab-buttons">
        <button class="active" onclick="switchTab('login')">Login</button>
        <button onclick="switchTab('signup')">Signup</button>
      </div>

      <!-- LOGIN FORM -->
      <form id="loginForm" class="admin-form form-container active">
        <label>Login Email:</label> <br>
        <input id="signin_email" type="email" name="email" placeholder="example@gmail.com" required> <br>

        <label>Login Password:</label> <br>
        <input id="signin_password" type="password" name="password" placeholder="Enter password" required> <br>

        <button id="signin_btn" type="submit">Login</button>
      </form>

      <!-- SIGNUP FORM -->
      <form id="signupForm" class="admin-form form-container">
        <label>Enter Email:</label> <br>
        <input id="signup_email" type="email" name="email" placeholder="example@gmail.com" required> <br>

        <label>Create Password:</label> <br>
        <input id="signup_password" type="password" name="password" placeholder="Create password" required> <br>

        <button id="signup_btn" type="submit">Signup</button>
      </form>

      <p id="errorMessage" style="color:red; display:none; margin-top:10px;"></p>
    </div>
  </section>

  <!-- Footer (Copied Exactly) -->
  <footer class="footer">
    <div class="footer-content">
      <p>&copy; 2025 | Uttara University Blood Club</p>
      <p>Developed by: <strong>Team Metrorail</strong></p>

      <h2>Our Team</h2>
      <div class="team-profiles">
        <a href="https://github.com/Ctrl-LNB/" target="_blank"><img src="https://github.com/Ctrl-LNB.png" title="Lutfun Nahar Barsha"></a>
        <a href="https://github.com/Mrh-Script/" target="_blank"><img src="https://github.com/Mrh-Script.png" title="Md. Riad Hasan"></a>
        <a href="https://github.com/kowser-mahmood" target="_blank"><img src="https://github.com/kowser-mahmood.png" title="Md. Kowser Mahmood"></a>
        <a href="https://github.com/tanzimulahsan-10zim" target="_blank"><img src="https://github.com/tanzimulahsan-10zim.png" title="Md. Tanzimul Ahsan"></a>
        <a href="https://github.com/Jowel-Rana-JR-99" title="Md. Juwel Rana" target="_blank"><img src="https://github.com/Jowel-Rana-JR-99.png" title="Md. Juwel Rana"></a>
      </div>

      <h2>Contact Us (UU)</h2>
      <div class="social-icons">
        <a href="https://www.facebook.com/UttaraUniversity" target="_blank"><i class="fa-brands fa-facebook-f"></i></a>
        <a href="https://x.com/Uttara_Varsity" target="_blank"><i class="fa-brands fa-x-twitter"></i></a>
        <a href="https://www.youtube.com/c/UttaraUniversityofficial" target="_blank"><i class="fa-brands fa-youtube"></i></a>
      </div>
    </div>
  </footer>

  <script>
    function switchTab(tab) {
      document.querySelectorAll(".form-container").forEach(f => f.classList.remove("active"));
      document.querySelectorAll(".tab-buttons button").forEach(btn => btn.classList.remove("active"));

      if (tab === "login") {
        document.getElementById("loginForm").classList.add("active");
        document.querySelector(".tab-buttons button:nth-child(1)").classList.add("active");
      } else {
        document.getElementById("signupForm").classList.add("active");
        document.querySelector(".tab-buttons button:nth-child(2)").classList.add("active");
      }
    }
  </script>

  <script src="../js/main.js"></script>
  <script src="../js/user_auth.js"></script>
</body>
</html>
