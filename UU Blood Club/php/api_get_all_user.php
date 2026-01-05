<?php
header("Content-Type: application/json");

include("db_connect.php");

try {
    $sql = "SELECT USER_ID, u_id, NAME, EMAIL, PASSWORD FROM users";
    $result = $conn->query($sql);

    if ($result === false) {
        throw new Exception($conn->error);
    }

    $users = [];
    while ($row = $result->fetch_assoc()) {
        $users[] = $row;
    }

    echo json_encode([
        "status" => "success",
        "data" => $users
    ]);

} catch (Exception $e) {
    echo json_encode([
        "status" => "error",
        "message" => $e->getMessage()
    ]);
}
?>
