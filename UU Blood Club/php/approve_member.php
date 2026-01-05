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

if ($type === 'memberships') {
    $table = 'memberships';
    $idField = 'MEMBER_ID';
} elseif ($type === 'donors') {
    $table = 'donors';
    $idField = 'DONOR_ID';
} else {
    echo json_encode(['status' => 'Invalid type']);
    exit;
}

$sql = "UPDATE $table SET STATUS = 'approved' WHERE $idField = ?";
$stmt = $conn->prepare($sql);

if ($stmt) {
    $stmt->bind_param('i', $id);
    if ($stmt->execute()) {
        if ($stmt->affected_rows > 0) {
            echo json_encode(['status' => 'approved']);
        } else {
            echo json_encode(['status' => 'No rows updated, check ID']);
        }
    } else {
        echo json_encode(['status' => 'Update failed: '.$stmt->error]);
    }
    $stmt->close();
} else {
    echo json_encode(['status' => 'Prepare failed: '.$conn->error]);
}

$conn->close();
?>
