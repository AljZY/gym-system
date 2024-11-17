<?php
include '../../../config/database.php';

session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: ../../../admin.php");
    exit();
}

function generateTempPassword($length = 8) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ!@#$%^&*()';
    $charactersLength = strlen($characters);
    $tempPassword = '';
    for ($i = 0; $i < $length; $i++) {
        $tempPassword .= $characters[rand(0, $charactersLength - 1)];
    }
    return $tempPassword;
}

$member_name = $_POST['member_name'];
$address = $_POST['address'];
$contact = $_POST['contact'];
$plan = $_POST['plan'];
$start_date = new DateTime();

$check_sql = "SELECT * FROM members WHERE member_name = '$member_name'";
$check_result = $conn->query($check_sql);

if ($check_result->num_rows > 0) {
    $error_message = "Member name already exists";
    header("Location: ../../../src/admin/member/addMembers.php?error=" . urlencode($error_message) . 
        "&member_name=" . urlencode($member_name) . 
        "&address=" . urlencode($address) . 
        "&contact=" . urlencode($contact) . 
        "&plan=" . urlencode($plan));
    exit();
}

switch ($plan) {
    case '1 week':
        $duration = new DateInterval('P7D');
        break;
    case '1 month':
        $duration = new DateInterval('P1M');
        break;
    case '3 months':
        $duration = new DateInterval('P3M');
        break;
    default:
        $duration = new DateInterval('P0D');
}

$end_date = clone $start_date;
$end_date->add($duration);

$tempPassword = generateTempPassword();

$sql = "INSERT INTO members (member_name, address, contact, plan, start_date, end_date, temp_password) 
        VALUES ('$member_name', '$address', '$contact', '$plan', '{$start_date->format('Y-m-d')}', '{$end_date->format('Y-m-d')}', '$tempPassword')";

if ($conn->query($sql) === TRUE) {
    header("Location: ../../../src/admin/member/addMembers.php?success=" . urlencode("Member added successfully"));
    exit();
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
