<?php
include '../../../config/database.php';

session_start();

if (!isset($_SESSION['admin'])) {
    header("Location: ../../../admin.php");
    exit();
}

$payment_id = $_GET['id'];

$sql = "DELETE FROM payment WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $payment_id);

if ($stmt->execute()) {
    header("Location: ../../../src/admin/payment/payment.php?success=1");
} else {
    echo "Error deleting payment: " . $conn->error;
}

$stmt->close();
$conn->close();
?>
