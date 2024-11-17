<?php
include '../../../config/database.php';

session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: ../../../admin.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $item_no = $_POST['item_no'];

    $sql = "DELETE FROM inventory WHERE item_no = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $item_no);

    if ($stmt->execute()) {
        echo "Item deleted successfully";
    } else {
        echo "Error: " . $stmt->error;
    }
    $stmt->close();
}

header("Location: ../../../src/admin/inventory/inventory.php");
exit();

$conn->close();
?>
