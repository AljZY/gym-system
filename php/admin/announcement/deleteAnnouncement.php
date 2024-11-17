<?php
include '../../../config/database.php';

session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: ../../../admin.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $delete_id = $_POST['id'];
    $sql = "DELETE FROM announcement WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $delete_id);

    if ($stmt->execute()) {
        echo "Successfully Deleted";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}

header("Location: ../../../src/admin/announcement/announcement.php");
exit();

$conn->close();
?>
