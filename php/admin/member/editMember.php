<?php
include '../../../config/database.php';

session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: ../../../admin.php");
    exit();
}

$id = $_POST['id'];
$member_name = $_POST['member_name'];
$address = $_POST['address'];
$contact = $_POST['contact'];
$plan = $_POST['plan'];

$start_date = new DateTime();

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

$check_sql = "SELECT * FROM members WHERE member_name = '$member_name' AND id != '$id'";
$check_result = $conn->query($check_sql);

if ($check_result->num_rows > 0) {
    $error_message = "Member name already exists";
    header("Location: ../../../src/admin/member/editMember.php?error=" . urlencode($error_message) . 
        "&id=" . urlencode($id) . 
        "&member_name=" . urlencode($member_name) . 
        "&address=" . urlencode($address) . 
        "&contact=" . urlencode($contact) . 
        "&plan=" . urlencode($plan));
    exit();
} else {
    $sql = "UPDATE members SET member_name='$member_name', address='$address', contact='$contact', plan='$plan', start_date='{$start_date->format('Y-m-d H:i:s')}', end_date='{$end_date->format('Y-m-d H:i:s')}' WHERE id='$id'";

    if ($conn->query($sql) === TRUE) {
        header("Location: ../../../src/admin/member/members.php?success=Member updated successfully");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>
