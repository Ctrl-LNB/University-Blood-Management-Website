<?php
session_start();
if (!isset($_SESSION['admin_logged_in'])) {
    echo json_encode(['status' => 'Unauthorized']);
    exit;
}

include("db_connect.php");

$type = $_POST['type'] ?? '';
$id = $_POST['id'] ?? '';

if (!$type || !$id) {
    echo json_encode(['status' => 'Missing parameters']);
    exit;
}

// ----------- ORIGINAL LOGIC (UNCHANGED) -----------
if ($type === 'memberships') {
    $table = 'memberships';
    $idField = 'MEMBER_ID';
} elseif ($type === 'donors') {
    $table = 'donors';
    $idField = 'DONOR_ID';
}
// ✅ ONLY NEWLY ADDED FOR USERS
elseif ($type === 'users') {
    $table = 'users';
    $idField = 'USER_ID';
}
else {
    echo json_encode(['status' => 'Invalid type']);
    exit;
}

// ----------- DELETE QUERY (UNCHANGED) -----------
$stmt = $conn->prepare("DELETE FROM $table WHERE $idField = ?");
if ($stmt) {
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        echo json_encode(['status' => 'Record deleted successfully']);
    } else {
        echo json_encode(['status' => 'Delete failed: ' . $stmt->error]);
    }
    $stmt->close();
} else {
    echo json_encode(['status' => 'Prepare failed: ' . $conn->error]);
}

$conn->close();
?>
