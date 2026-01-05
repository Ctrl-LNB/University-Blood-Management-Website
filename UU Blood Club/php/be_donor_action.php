<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include_once __DIR__ . "/db_connect.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $full_name          = $_POST['full_name'] ?? '';
    $gender             = $_POST['gender'] ?? '';
    $email              = $_POST['email'] ?? '';
    $id_number          = $_POST['id_number'] ?? '';
    $blood_group        = $_POST['blood_group'] ?? '';
    $last_donation_date = $_POST['last_donation_date'] ?? '';
    $address            = $_POST['address'] ?? '';
    $phone_number       = $_POST['phone_number'] ?? '';
    $occupation         = $_POST['occupation'] ?? '';

    if (
        empty($full_name) || empty($gender) || empty($email) ||
        empty($id_number) || empty($blood_group) || empty($last_donation_date) ||
        empty($address) || empty($phone_number) || empty($occupation)
    ) {
        die("All fields are required.");
    }

    $sql = "INSERT INTO donors 
        (FULL_NAME, GENDER, EMAIL, ID_NUMBER, BLOOD_GROUP, LAST_DONATION_DATE, ADDRESS, PHONE_NUMBER, OCCUPATION)
        VALUES (
            '$full_name','$gender','$email','$id_number','$blood_group',
            '$last_donation_date','$address','$phone_number','$occupation'
        )";

    if (mysqli_query($conn, $sql)) {
        echo "<h2 style='color:green;'>✅ Donor Registered Successfully!</h2>";
        echo "<a href='../be_donor.html' style='
            padding:10px 20px;
            background:#e63946;
            color:white;
            text-decoration:none;
            border-radius:6px;
            font-weight:bold;
            display:inline-block;
            margin-top:10px;
        '>Go Back</a>";
    } else {
        echo "<h2 style='color:red;'>Database Error: " . mysqli_error($conn) . "</h2>";
    }

    mysqli_close($conn);
}
?>
