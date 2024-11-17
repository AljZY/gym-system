<?php
include '../../../config/database.php';

session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: ../../../admin.php");
    exit();
}

$id = $_GET['id'];

$sql = "DELETE FROM members WHERE id='$id'";

if ($conn->query($sql) === TRUE) {
    header("Location: ../../../src/admin/member/members.php?success=Member deleted successfully");
    exit();
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
