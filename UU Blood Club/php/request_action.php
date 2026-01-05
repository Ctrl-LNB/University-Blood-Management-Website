<?php
include("db_connect.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $blood_group = $_POST['blood_group'];

    // Store the request
    $sql_insert = "INSERT INTO REQUESTS (BLOOD_GROUP) VALUES ('$blood_group')";
    mysqli_query($conn, $sql_insert);

    // Search donors
    $sql_search = "SELECT FULL_NAME, PHONE_NUMBER, ADDRESS, LAST_DONATION_DATE 
                   FROM DONORS 
                   WHERE BLOOD_GROUP = '$blood_group'";

    $result = mysqli_query($conn, $sql_search);

    echo "<h2>Donors with Blood Group $blood_group</h2>";

    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<div style='border:1px solid #ccc; padding:10px; margin:10px;'>
                    <p><b>Name:</b> {$row['FULL_NAME']}</p>
                    <p><b>Phone:</b> {$row['PHONE_NUMBER']}</p>
                    <p><b>Address:</b> {$row['ADDRESS']}</p>
                    <p><b>Last Donation:</b> {$row['LAST_DONATION_DATE']}</p>
                  </div>";
        }
    } else {
        echo "<p>No donors found for this blood group.</p>";
    }

    echo "<a href='../find_donor.html'>Go Back</a>";

    mysqli_close($conn);
}
?>
