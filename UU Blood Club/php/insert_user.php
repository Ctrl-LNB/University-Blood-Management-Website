<?php
header("Content-Type: application/json");
include("db_connect.php");

$data = json_decode(file_get_contents("php://input"), true);

if (!$data) {
    echo json_encode(["status" => "error", "message" => "No data received"]);
    exit;
}

$email    = trim($data["email"] ?? "");
$password = trim($data["password"] ?? "");

if ($email === "" || $password === "") {
    echo json_encode(["status" => "error", "message" => "All fields are required"]);
    exit;
}


$userEmail = null;
$result = $conn->query("SELECT EMAIL FROM users WHERE EMAIL = '".$conn->real_escape_string($email)."' LIMIT 1");
if ($row = $result->fetch_assoc()) {
    echo json_encode(["status" => "error", "message" => "Email already registered"]);
    exit;
}

$donorEmail = null;
$result = $conn->query("SELECT EMAIL FROM donors WHERE EMAIL = '".$conn->real_escape_string($email)."' LIMIT 1");
if ($row = $result->fetch_assoc()) $donorEmail = $row['EMAIL'];

$membershipEmail = null;
$result = $conn->query("SELECT EMAIL FROM memberships WHERE EMAIL = '".$conn->real_escape_string($email)."' LIMIT 1");
if ($row = $result->fetch_assoc()) $membershipEmail = $row['EMAIL'];

if (!$donorEmail && !$membershipEmail) {
    echo json_encode(["status" => "error", "message" => "Membership or donor record required"]);
    exit;
}

$plain_password = $password;

$id_name_sql = "
    SELECT COALESCE(d.ID_NUMBER, m.ID_NUMBER) AS u_id,
           COALESCE(d.FULL_NAME, m.FULL_NAME) AS name
    FROM donors d
    LEFT JOIN memberships m ON d.EMAIL = m.EMAIL
    WHERE d.EMAIL = ?

    UNION ALL

    SELECT COALESCE(d.ID_NUMBER, m.ID_NUMBER) AS u_id,
           COALESCE(d.FULL_NAME, m.FULL_NAME) AS name
    FROM memberships m
    LEFT JOIN donors d ON m.EMAIL = d.EMAIL
    WHERE m.EMAIL = ? AND d.EMAIL IS NULL
    LIMIT 1
";


$stmt = $conn->prepare($id_name_sql);
$stmt->bind_param("ss", $email, $email);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();
$stmt->close();

$u_id = $row['u_id'] ?? null;
$name = $row['name'] ?? null;


$sql = "INSERT INTO users (u_id, name, EMAIL, PASSWORD) VALUES ( ?, ?, ?, ?)";
$stmt = $conn->prepare($sql);

if (!$stmt) {
    echo json_encode(["status" => "error", "message" => "SQL prepare error"]);
    exit;
}

$stmt->bind_param("ssss",$u_id, $name, $email, $plain_password);

if ($stmt->execute()) {
    echo json_encode(["status" => "success", "message" => "User registered successfully"]);
} else {
    if ($conn->errno === 1062) {
        echo json_encode(["status" => "error", "message" => "Email already exists"]);
    } else {
        echo json_encode(["status" => "error", "message" => "Database insertion failed"]);
    }
}

?>
