<?php
session_start();
header('Content-Type: application/json');
include "db_connect.php";

if (!isset($_SESSION['USER']['EMAIL'])) {
    echo json_encode([
        "status" => "error",
        "message" => "User not logged in"
    ]);
    exit;
}

$email = $_SESSION['USER']['EMAIL'];

$phone = isset($_POST['phone_number']) ? trim($_POST['phone_number']) : null;
$address = isset($_POST['address']) ? trim($_POST['address']) : null;
$lastDonation = isset($_POST['last_donation']) ? trim($_POST['last_donation']) : null;

try {
    // Update donors if exists
    $stmtCheck = $conn->prepare("SELECT DONOR_ID FROM donors WHERE EMAIL = ?");
    $stmtCheck->bind_param("s", $email);
    $stmtCheck->execute();
    $resCheck = $stmtCheck->get_result();
    $donorExists = $resCheck->num_rows > 0;
    $stmtCheck->close();

    if ($donorExists) {
        // Build dynamic query
        $fields = [];
        $params = [];
        $types = "";

        if ($phone !== null && $phone !== "") {
            $fields[] = "PHONE_NUMBER = ?";
            $params[] = $phone;
            $types .= "s";
        }
        if ($address !== null && $address !== "") {
            $fields[] = "ADDRESS = ?";
            $params[] = $address;
            $types .= "s";
        }
        if ($lastDonation !== null && $lastDonation !== "") {
            $fields[] = "LAST_DONATION_DATE = ?";
            $params[] = $lastDonation;
            $types .= "s";
        }

        if (count($fields) > 0) {
            $sql = "UPDATE donors SET " . implode(", ", $fields) . " WHERE EMAIL = ?";
            $params[] = $email;
            $types .= "s";

            $stmt = $conn->prepare($sql);
            $stmt->bind_param($types, ...$params);
            $stmt->execute();
            $stmt->close();
        }
    }

    $stmtCheckM = $conn->prepare("SELECT MEMBER_ID FROM memberships WHERE EMAIL = ?");
    $stmtCheckM->bind_param("s", $email);
    $stmtCheckM->execute();
    $resCheckM = $stmtCheckM->get_result();
    $membershipExists = $resCheckM->num_rows > 0;
    $stmtCheckM->close();

    if ($membershipExists) {
        $fieldsM = [];
        $paramsM = [];
        $typesM = "";

        if ($phone !== null && $phone !== "") {
            $fieldsM[] = "PHONE_NUMBER = ?";
            $paramsM[] = $phone;
            $typesM .= "s";
        }
        if ($address !== null && $address !== "") {
            $fieldsM[] = "ADDRESS = ?";
            $paramsM[] = $address;
            $typesM .= "s";
        }
        if ($lastDonation !== null && $lastDonation !== "") {
            $fieldsM[] = "JOIN_DATE = ?";
            $paramsM[] = $lastDonation;
            $typesM .= "s";
        }

        if (count($fieldsM) > 0) {
            $sqlM = "UPDATE memberships SET " . implode(", ", $fieldsM) . " WHERE EMAIL = ?";
            $paramsM[] = $email;
            $typesM .= "s";

            $stmtM = $conn->prepare($sqlM);
            $stmtM->bind_param($typesM, ...$paramsM);
            $stmtM->execute();
            $stmtM->close();
        }
    }

    echo json_encode([
        "status" => "success",
        "message" => "User data updated successfully"
    ]);
    exit;

} catch (Exception $e) {
    http_response_code(500);
    echo json_encode([
        "status" => "error",
        "message" => "Database error: " . $e->getMessage()
    ]);
}