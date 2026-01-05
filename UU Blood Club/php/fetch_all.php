<?php
header('Content-Type: application/json');
include("db_connect.php");

// Get the request type (e.g. ?type=memberships or ?type=donors)

$data = [];

$sql = "
SELECT 
    MEMBER_ID AS ID,
    FULL_NAME,
    ID_NUMBER,
    BLOOD_GROUP,
    PHONE_NUMBER,
    ADDRESS,
    'Member' AS TYPE,
    JOIN_DATE AS LAST_DONATION_DATE
FROM memberships

UNION ALL

SELECT 
    DONOR_ID AS ID,
    FULL_NAME,
    ID_NUMBER,
    BLOOD_GROUP,
    PHONE_NUMBER,
    ADDRESS,
    'Donor' AS TYPE,
    LAST_DONATION_DATE
FROM donors

ORDER BY FULL_NAME;
";


$result = mysqli_query($conn, $sql);

if ($result) {
    while ($row = mysqli_fetch_assoc($result)) {
        $data[] = $row;
    }

    echo json_encode([
        'status' => 'success',
        'count' => count($data),
        'data' => $data
    ]);
} else {
    echo json_encode([
        'status' => 'error',
        'message' => 'Database query failed.',
        'error' => mysqli_error($conn)
    ]);
}
