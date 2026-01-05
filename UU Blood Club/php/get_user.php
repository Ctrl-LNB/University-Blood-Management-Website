<?php
session_start();
header('Content-Type: application/json');
include "db_connect.php";

if (!isset($_SESSION['USER']['USER_ID']) || !isset($_SESSION['USER']['EMAIL'])) {
    echo json_encode([
        "status" => "error",
        "message" => "User not logged in or session expired"
    ]);
    exit;
}

$session_user_id = $_SESSION['USER']['USER_ID'];
$email = $_SESSION['USER']['EMAIL'];

try {
    $sqlUser = "SELECT USER_ID, EMAIL FROM users WHERE USER_ID = ? LIMIT 1";
    $stmtUser = $conn->prepare($sqlUser);
    if (!$stmtUser) throw new Exception("Prepare failed (users): " . $conn->error);

    $stmtUser->bind_param("i", $session_user_id);
    $stmtUser->execute();
    $resUser = $stmtUser->get_result();
    $userRow = $resUser->fetch_assoc();
    $stmtUser->close();

    if (!$userRow) {
        echo json_encode([
            "status" => "error",
            "message" => "User not found in users table"
        ]);
        exit;
    }
    
    $sqlMerge = "
        SELECT
    COALESCE(d.FULL_NAME, m.FULL_NAME) AS NAME,
    COALESCE(d.ID_NUMBER, m.ID_NUMBER) AS u_id,
    COALESCE(d.PHONE_NUMBER, m.PHONE_NUMBER) AS PHONE_NUMBER,
    COALESCE(d.ADDRESS, m.ADDRESS) AS ADDRESS,
    COALESCE(d.LAST_DONATION_DATE, m.JOIN_DATE) AS LAST_DONATION_DATE
FROM donors d
LEFT JOIN memberships m ON d.EMAIL = m.EMAIL
WHERE d.EMAIL = ?

UNION ALL

SELECT
    COALESCE(d.FULL_NAME, m.FULL_NAME) AS NAME,
    COALESCE(d.ID_NUMBER, m.ID_NUMBER) AS u_id,
    COALESCE(d.PHONE_NUMBER, m.PHONE_NUMBER) AS PHONE_NUMBER,
    COALESCE(d.ADDRESS, m.ADDRESS) AS ADDRESS,
    COALESCE(d.LAST_DONATION_DATE, m.JOIN_DATE) AS LAST_DONATION_DATE
FROM memberships m
LEFT JOIN donors d ON m.EMAIL = d.EMAIL
WHERE m.EMAIL = ? AND d.EMAIL IS NULL
LIMIT 1;

    ";
    $stmtMerge = $conn->prepare($sqlMerge);
    if (!$stmtMerge) throw new Exception("Prepare failed (merge): " . $conn->error);

    $stmtMerge->bind_param("ss", $email, $email);
    $stmtMerge->execute();
    $resMerge = $stmtMerge->get_result();
    $mergeRow = $resMerge->fetch_assoc();
    $stmtMerge->close();

    $final = [
        "USER_ID" => $userRow['USER_ID'],
        "EMAIL" => $userRow['EMAIL'],
        "PHONE_NUMBER" => null,
        "ADDRESS" => null,
        "LAST_DONATION_DATE" => null
    ];

    if ($mergeRow) {
        $final['NAME'] = $mergeRow['NAME'] ?? null;
        $final['u_id'] = $mergeRow['u_id'] ?? null;
        $final['PHONE_NUMBER'] = $mergeRow['PHONE_NUMBER'] ?? null;
        $final['ADDRESS'] = $mergeRow['ADDRESS'] ?? null;
        $final['LAST_DONATION_DATE'] = $mergeRow['LAST_DONATION_DATE'] ?? null;
    } else {
    }

    echo json_encode([
        "status" => "success",
        "data" => $final
    ]);
    exit;

} catch (Exception $e) {
    http_response_code(500);
    echo json_encode([
        "status" => "error",
        "message" => "Server error: " . $e->getMessage()
    ]);
    exit;
}
