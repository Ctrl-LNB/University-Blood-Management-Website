<?php
session_start();
if (!isset($_SESSION['USER'])) {
    header("Location: user.php");
    exit;
}

$user = $_SESSION['USER'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>User Profile Update</title>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">

<link rel="stylesheet" href="../css/navbar.css">

<style>
/* ---------------------- */
/* GLOBAL STYLES */
/* ---------------------- */
* {
    font-family: 'JetBrains Mono', monospace;
    box-sizing: border-box;
}

body {
    margin: 0;
    padding: 0;
    min-height: 100vh;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: flex-start;

    background-image: url(""); 
    background-size: cover;
    background-position: center;
    background-repeat: no-repeat;
    position: relative;
}


body::before {
    content: "";
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.25); 
    z-index: 0;
}

/* ---------------------- */
/* CONTAINER STYLES */
/* ---------------------- */
.container {
    position: relative;
    z-index: 1;
    background: white;
    width: 420px;
    padding: 25px;
    border-radius: 12px;
    box-shadow: 0 4px 12px rgba(0,0,0,0.2);
    margin-top: 140px;
}

h2 {
    text-align: center;
    margin-bottom: 25px;
    color: #333;
}

label {
    font-weight: bold;
    margin-bottom: 5px;
    display: block;
    color: #444;
}

input, select {
    width: 100%;
    padding: 10px;
    margin-bottom: 15px;
    border-radius: 6px;
    border: 1px solid #ccc;
    font-size: 15px;
}

input[readonly] {
    background: #e8e8e8;
    cursor: not-allowed;
}

/* Buttons container */
.button-group {
    display: flex;
    justify-content: space-between;
    gap: 10px;
    margin-top: 10px;
}

.update-btn {
    flex: 1;
    padding: 12px;
    background: #b30000;
    border: none;
    color: white;
    font-size: 16px;
    border-radius: 6px;
    cursor: pointer;
    transition: 0.3s;
}

.update-btn:hover {
    background: #f50d0dff;
}

.logout-btn {
    flex: 1;
    padding: 12px;
    background: #444;
    border: none;
    color: white;
    font-size: 16px;
    border-radius: 6px;
    cursor: pointer;
    transition: 0.3s;
    text-align: center;
    text-decoration: none;
    display: inline-block;
}

.logout-btn:hover {
    background: #222;
}

/* ---------------------- */
/* FOOTER CSS */
/* ---------------------- */
.footer {
    background-color: #b30000;
    color: white;
    text-align: center;
    margin-top: 50px;
    border-top: 3px solid #b30000;
    width: 100vw;
    position: relative;
    z-index: 1;
}

.footer-content {
    max-width: 100vw;
    margin: auto;
    padding: 20px 0;
}

.footer p {
    margin: 8px 0;
    font-size: 16px;
    font-weight: bold;
}

.social-icons {
    margin-top: 10px;
}

.social-icons a {
    color: white;
    margin: 0 10px;
    font-size: 22px;
    text-decoration: none;
    transition: transform 0.3s ease, color 0.3s ease;
}

.social-icons a:hover {
    color: black;
    transform: scale(1.3);
}

/* Footer Logo */
.footer-logo-container {
    margin-top: 10px;
    text-align: center;
}

.footer-logo-container img {
    width: 100px;
    height: auto;
    border-radius: 50%;
}

/* Team Profile */
.team-profiles {
    display: flex;
    justify-content: center;
    gap: 15px;
    margin-top: 15px;
    flex-wrap: wrap;
}

.team-profiles a img {
    width: 60px;
    height: 60px;
    border-radius: 50%;
    border: 2px solid white;
    transition: transform 0.3s ease, border-color 0.3s ease;
}

.team-profiles a img:hover {
    transform: scale(1.2);
    border-color: #000;
}

/* Responsive Footer */
@media (max-width: 768px) {
    .footer p {
        font-size: 14px;
    }

    .social-icons a {
        font-size: 20px;
    }
}
</style>

</head>

<body>

<!-- ⭐ Navigation Bar -->
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

<!-- ⭐ Profile Update Section -->
<div class="container">
    <h2>Update Your Profile</h2>

    <form id="updateForm">
    <label>Name</label>
    <input type="text" id="name" readonly>
    

    <label>Varsity ID</label>
    <input type="text" id="varsity_id" readonly>

    <label>Email</label>
    <input type="email" id="email" readonly>

    <!-- Phone Number field -->
    <label>Phone Number</label>
    <input type="tel" id="phone_number">

    <!-- Address field -->
    <label>Address</label>
    <input type="text" id="address">

    <!-- Last Donation Date field -->
    <label>Last Donation Date</label>
    <input type="date" id="last_donation">

    <div class="button-group">
        <button type="button" class="update-btn" onclick="updateUser()">Update</button>
        <button id="logoutBtn" type="button" class="logout-btn">Logout</button>
    </div>
</form>

</div>

<!-- ✅ Footer -->
<footer class="footer">
    <div class="footer-content">
      <p>&copy; 2025 | Uttara University Blood Club</p>
      <p>Developed by: <strong>Team Metrorail</strong></p>

      <h2 style="color: #fff">Our Team</h2>
      <div class="team-profiles">
        <a href="https://github.com/Ctrl-LNB/" target="_blank"><img src="https://github.com/Ctrl-LNB.png" title="Lutfun Nahar Barsha"></a>
        <a href="https://github.com/Mrh-Script/" target="_blank"><img src="https://github.com/Mrh-Script.png" title="Md. Riad Hasan"></a>
        <a href="https://github.com/kowser-mahmood" target="_blank"><img src="https://github.com/kowser-mahmood.png" title="Md. Kowser Mahmood"></a>
        <a href="https://github.com/tanzimulahsan-10zim" target="_blank"><img src="https://github.com/tanzimulahsan-10zim.png" title="Md. Tanzimul Ahsan"></a>
        <a href="https://github.com/Jowel-Rana-JR-99" title="Md. Juwel Rana" target="_blank"><img src="https://github.com/Jowel-Rana-JR-99.png" title="Md. Juwel Rana"></a>
      </div>

      <h2 style="color: #fff">Contact Us (UU)</h2>
      <div class="social-icons">
        <a href="https://www.facebook.com/UttaraUniversity" target="_blank"><i class="fab fa-facebook-f"></i></a>
        <a href="https://x.com/Uttara_Varsity" target="_blank"><i class="fab fa-x-twitter"></i></a>
        <a href="https://www.youtube.com/c/UttaraUniversityofficial" target="_blank"><i class="fab fa-youtube"></i></a>
      </div>
    </div>
</footer>

<script>
const loadData = async () => {
    const data = await fetch('get_user.php')
    .then(res => res.json())
    .catch(e => console.error(e));

    const {EMAIL, NAME, u_id, PHONE_NUMBER, ADDRESS, LAST_DONATION_DATE} = data.data;
    document.getElementById("name").value = NAME || "unknown";
    document.getElementById("varsity_id").value = u_id || "null";
    document.getElementById("email").value = EMAIL || "not set";
    document.getElementById("phone_number").value = PHONE_NUMBER || "not set";
    document.getElementById("address").value = ADDRESS || "not set";
    if (LAST_DONATION_DATE && LAST_DONATION_DATE.includes(" ")) {
    document.getElementById("last_donation").value = LAST_DONATION_DATE.split(" ")[0];
} else {
    document.getElementById("last_donation").value = LAST_DONATION_DATE || "";
}

}

loadData();

function updateUser() {
    const userData = new URLSearchParams({
        phone_number: document.getElementById("phone_number").value,
        address: document.getElementById("address").value,
        last_donation: document.getElementById("last_donation").value
    });

    fetch("update_user.php", {
        method: "POST",
        body: userData
    })
    .then(res => res.json())
    .then(data => alert(data.message))
    .catch(err => alert("Error updating profile"));
}


document.getElementById('logoutBtn').addEventListener('click', (e)=>{
    e.preventDefault();
    if (confirm("Are you sure you want to logout?")) {
    window.location.href = "logout_user.php";
  }
});
</script>

</body>
</html>
