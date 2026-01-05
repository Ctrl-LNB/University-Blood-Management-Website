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

$data = $_POST;
unset($data['id'], $data['type']);

// Build SET clause
$set = [];
$params = [];
$types = '';
foreach ($data as $column => $value) {
    $set[] = "$column = ?";
    $params[] = $value;
    $types .= 's';
}
$params[] = $id;
$types .= 'i';

$setString = implode(', ', $set);

$stmt = $conn->prepare("UPDATE $table SET $setString WHERE $idField = ?");
if ($stmt) {
    $stmt->bind_param($types, ...$params);
    if ($stmt->execute()) {
        echo json_encode(['status' => 'Record updated successfully']);
    } else {
        echo json_encode(['status' => 'Update failed: '.$stmt->error]);
    }
    $stmt->close();
} else {
    echo json_encode(['status' => 'Prepare failed: '.$conn->error]);
}

$conn->close();
?>