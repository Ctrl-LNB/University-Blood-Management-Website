<?php
session_start();
header('Content-Type: application/json');
include "db_connect.php";


$data = json_decode(file_get_contents("php://input"), true);

$email = trim($data['email'] ?? '');
$password = trim($data['password'] ?? '');

if (!$email || !$password) {
    echo json_encode([
        "status" => "error",
        "message" => "Email and password are required"
    ]);
    exit;
}

try {
    // Prepare SQL statement
    $stmt = $conn->prepare("SELECT USER_ID, NAME, EMAIL, PASSWORD FROM users WHERE EMAIL = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    if ($user) {
        if ($user['PASSWORD'] === $password) {
            $_SESSION['USER'] = [
            "USER_ID" => $user['USER_ID'],
            "NAME" => $user['NAME'],
            "EMAIL" => $user['EMAIL']
        ];
        
            echo json_encode([
                "status" => "success",
                "message" => "Login successful",
                "data" => [
                    "USER_ID" => $user['USER_ID'],
                    "NAME" => $user['NAME'],
                    "EMAIL" => $user['EMAIL']
                ]
            ]);
        } else {
            echo json_encode([
                "status" => "error",
                "message" => "Incorrect password"
            ]);
        }
    } else {
        echo json_encode([
            "status" => "error",
            "message" => "Email not found"
        ]);
    }

} catch (Exception $e) {
    echo json_encode([
        "status" => "error",
        "message" => "Database error: " . $e->getMessage()
    ]);
}

?>
