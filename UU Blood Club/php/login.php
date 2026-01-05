<?php
ob_start();
session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include("db_connect.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = $_POST['password'];

    $sql = "SELECT * FROM admin_panel WHERE EMAIL='$email'";
    $result = mysqli_query($conn, $sql) or die("Query failed: " . mysqli_error($conn));

    if (mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_assoc($result);

        if ($password == $row['PASSWORD']) {
            $_SESSION['admin_logged_in'] = true;
            $_SESSION['admin_email'] = $row['EMAIL'];
            echo "<div><p style='text-align: center; font-size: 1.5rem; padding-top: 40px;'>loading...</p></div>";
            header("Refresh:1; url=dashboard.php");
            exit;
        } else {
            $error = "❌ Invalid email or password!";
        }
    } else {
        $error = "❌ Invalid email or password!";
    }
}

if(isset($error)){
    echo "<p style='color:red; text-align:center'>$error</p>";
}

ob_end_flush();
?>