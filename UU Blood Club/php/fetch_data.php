<?php
header('Content-Type: application/json');
include("db_connect.php");

$type = $_GET['type'] ?? '';

if ($type === 'memberships') {
    $sql = "SELECT * FROM memberships ORDER BY MEMBER_ID DESC";
} elseif ($type === 'donors') {
    $sql = "SELECT * FROM donors ORDER BY DONOR_ID DESC";
} else {
    echo json_encode([]);
    exit;
}

$result = mysqli_query($conn, $sql);

$data = [];
if ($result) {
    while ($row = mysqli_fetch_assoc($result)) {
        $data[] = $row;
    }
}

echo json_encode($data);
?>