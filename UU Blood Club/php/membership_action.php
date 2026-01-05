<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include_once __DIR__ . "/db_connect.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $full_name     = $_POST['full_name'] ?? '';
    $gender        = $_POST['gender'] ?? '';
    $id_number     = $_POST['id_number'] ?? '';
    $blood_group   = $_POST['blood_group'] ?? '';
    $email         = $_POST['email'] ?? '';
    $department    = $_POST['department'] ?? '';
    $batch         = $_POST['batch'] ?? '';
    $phone_number  = $_POST['phone_number'] ?? '';
    $address       = $_POST['address'] ?? '';

    if (
        empty($full_name) || empty($gender) || empty($id_number) ||
        empty($blood_group) || empty($email) || empty($department) ||
        empty($batch) || empty($phone_number) || empty($address)
    ) {
        die("<h2 style='color:red;'>❌ All fields are required.</h2>");
    }

    // IMPORTANT: Make sure your real table name is LOWERCASE in InfinityFree
    $sql = "INSERT INTO memberships
        (FULL_NAME, GENDER, ID_NUMBER, BLOOD_GROUP, EMAIL, DEPARTMENT, BATCH, PHONE_NUMBER, ADDRESS)
        VALUES (
            '$full_name',
            '$gender',
            '$id_number',
            '$blood_group',
            '$email',
            '$department',
            '$batch',
            '$phone_number',
            '$address'
        )";

    if (mysqli_query($conn, $sql)) {
        echo "<h2 style='color:green;'>✅ Membership Registered Successfully!</h2>";
        echo "<a href='../membership.html' style='
            padding:10px 20px;
            background:#e63946;
            color:white;
            text-decoration:none;
            border-radius:5px;
            font-weight:bold;
            display:inline-block;
            margin-top:10px;
        '>Go Back</a>";
    } else {
        echo "<h2 style='color:red;'>❌ Database Error: " . mysqli_error($conn) . "</h2>";
    }

    mysqli_close($conn);
}
?>
