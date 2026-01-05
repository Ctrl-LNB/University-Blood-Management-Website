<?php
header('Content-Type: application/json');
error_reporting(E_ALL);
ini_set('display_errors', 1);

include("db_connect.php");

$sql = "SELECT * FROM donors";

$sql = "SELECT 
    MEMBER_ID AS ID,
    FULL_NAME,
    ID_NUMBER,
    BLOOD_GROUP,
    PHONE_NUMBER,
    EMAIL,
    ADDRESS,
    'Member' AS TYPE,
    JOIN_DATE AS LAST_DONATION_DATE
FROM memberships
WHERE STATUS = 'approved'

UNION ALL

SELECT 
    DONOR_ID AS ID,
    FULL_NAME,
    ID_NUMBER,
    BLOOD_GROUP,
    PHONE_NUMBER,
    EMAIL,
    ADDRESS,
    'Donor' AS TYPE,
    LAST_DONATION_DATE
FROM donors
WHERE STATUS = 'approved'

ORDER BY FULL_NAME;
";

    
$result = $conn->query($sql);

if (!$result) {
    echo json_encode(["error" => $conn->error]);
    exit();
}

$donors = [];

while ($row = $result->fetch_assoc()) {
    $donors[] = $row;
}

echo json_encode($donors, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
?>
