<?php
include '../../../config/database.php';

session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: ../../../admin.php");
    exit();
}

$stmt = $conn->prepare("INSERT INTO payment (payment_date, name_or_alias, plan, amount) VALUES (?, ?, ?, ?)");
$stmt->bind_param("ssss", $payment_date, $name_or_alias, $plan, $amount);

$payment_date = $_POST['payment_date'];
$name_or_alias = $_POST['name_or_alias'];
$plan = $_POST['plan'];
$amount = $_POST['amount'];

if ($stmt->execute()) {
    header("Location: ../../../src/admin/payment/payment.php");
} else {
    echo "Error: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>
