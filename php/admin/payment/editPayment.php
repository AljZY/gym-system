<?php
session_start();
include '../../../config/database.php';

if (!isset($_SESSION['admin'])) {
    header("Location: ../../../admin.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $payment_date = $_POST['payment_date'];
    $name_or_alias = $_POST['name_or_alias'];
    $plan = $_POST['plan'];
    $amount = $_POST['amount'];

    $sql = "UPDATE payment SET payment_date = ?, name_or_alias = ?, plan = ?, amount = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssi", $payment_date, $name_or_alias, $plan, $amount, $id);

    if ($stmt->execute()) {
        header("Location: ../../../src/admin/payment/editPayment.php?id=$id&success=true");
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>
