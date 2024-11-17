<?php
include '../../../config/database.php';

session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: ../../../admin.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $item_no = $_POST['item_no'];
    $item_name = $_POST['item_name'];
    $price = $_POST['price'];
    $quantity = $_POST['quantity'];

    $sql = "UPDATE inventory SET item_name = ?, price = ?, quantity = ? WHERE item_no = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sdii", $item_name, $price, $quantity, $item_no);

    if ($stmt->execute()) {
        header("Location: ../../../src/admin/inventory/editItem.php?item_no=" . urlencode($item_no) . "&modal=1");
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }
    $stmt->close();
}

$conn->close();
?>