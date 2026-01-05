<?php
session_start();
if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: admin.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Admin Dashboard - UUBC</title>
<link rel="stylesheet" href="../css/dashboard.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
</head>
<body>

<div class="dashboard-container">
    <!-- Sidebar -->
    <aside class="sidebar">
        <div class="sidebar-header">
            <div class="logo-container">
                <h2>Tables</h2>
            </div>
        </div>
        <ul class="sidebar-menu">
            <li><button onclick="showTab('memberships')" class="active"><i class="fa-solid fa-users"></i> Memberships</button></li>
            <li><button onclick="showTab('donors')"><i class="fa-solid fa-hand-holding-droplet"></i> Donors</button></li>
            <li><button onclick="showTab('users')"><i class="fa-solid fa-user"></i> Users</button></li>
        </ul>
    </aside>

    <!-- Main Content -->
    <main class="main-content">
        <header class="main-header">
            <div class="header-left">
                <div class="logo-container">
                    <img src="../images/logo.png" height="34px" width="34px" alt="">
                    <h1>Admin Dashboard</h1>
                </div>
                <p>Manage members, donors, and users efficiently</p>
            </div>
            <div class="header-right">
                <button class="logout-btn" onclick="logout()"><i class="fa-solid fa-right-from-bracket"></i> Logout</button>
            </div>
        </header>

        <!-- Search -->
        <div class="action-bar">
            <input type="text" id="searchInput" placeholder="Search..." onkeyup="searchTable()">
        </div>

        <!-- Memberships Table -->
        <section id="memberships" class="tab-content active">
            <div class="table-container">
                <h2>Memberships</h2>
                <table id="membershipsTable">
                    <thead>
                        <tr>
                            <th>ID</th><th>Full Name</th><th>ID Number</th><th>Blood</th><th>Gender</th>
                            <th>Email</th><th>Department</th><th>Batch</th><th>Phone</th><th>Address</th>
                            <th>Time</th><th>Status</th><th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td><td>John Doe</td><td>12345</td><td>A+</td><td>Male</td>
                            <td>john@example.com</td>
                            <td>CSE</td><td>2022</td><td>0123456789</td><td>Dhaka</td>
                            <td>2025-11-09</td><td>Pending</td>
                            <td><button class="accept-btn"><i class="fa-solid fa-check"></i> Accept</button></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </section>

        <!-- Donors Table -->
        <section id="donors" class="tab-content">
            <div class="table-container">
                <h2>Donors</h2>
                <table id="donorsTable">
                    <thead>
                        <tr>
                            <th>ID</th><th>ID Number</th><th>Email</th><th>Full Name</th><th>Blood</th><th>Gender</th>
                            <th>Last Donation</th><th>Address</th><th>Phone</th><th>Occupation</th><th>Time</th><th>Status</th><th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td><td>Jane Smith</td><td>67890</td><td>B+</td><td>Female</td><td>jane@gmail.com</td>
                            <td>2025-09-12</td><td>Rajshahi</td><td>0198765432</td>
                            <td>2025-11-09</td><td>Pending</td>
                            <td><button class="accept-btn"><i class="fa-solid fa-check"></i> Accept</button></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </section>

        <!-- USERS TABLE -->
        <section id="users" class="tab-content">
            <div class="table-container">
                <h2>Users</h2>
                <table id="usersTable">
                    <thead>
                        <tr>
                            <th>ID</th><th>u_id</th><th>Name</th><th>Email</th><th>Password</th><th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>U001</td>
                            <td>Admin User</td>
                            <td>admin@gmail.com</td>
                            <td>••••••••</td>
                            <td>
                                <button class="delete-btn"><i class="fa-solid fa-trash"></i> Delete</button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </section>

    </main>
</div>

<script src="../js/dashboard.js"></script>
</body>
</html>
