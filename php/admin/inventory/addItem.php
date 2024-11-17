<?php
include '../../../config/database.php';

session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: ../../../admin.php");
    exit();
}

$showModal = false;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $item_no = $_POST['item_no'];
    $item_name = $_POST['item_name'];
    $price = $_POST['price'];
    $quantity = $_POST['quantity'];

    $sql = "INSERT INTO inventory (item_no, item_name, price, quantity) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssdi", $item_no, $item_name, $price, $quantity);

    if ($stmt->execute()) {
        $showModal = true;
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}

header("Location: ../../../src/admin/inventory/addItem.php?modal=" . ($showModal ? "1" : "0"));

$conn->close();
?>