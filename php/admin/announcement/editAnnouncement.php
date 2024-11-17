<?php
include '../../../config/database.php';

session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: ../../../admin.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $announcement_id = $_POST['announcement_id'];
    $announcement_text = $_POST['announcement_text'];

    $sql = "UPDATE announcement SET announcement_text = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("si", $announcement_text, $announcement_id);

    if ($stmt->execute()) {
        header("Location: ../../../src/admin/announcement/editAnnouncement.php?id=" . urlencode($announcement_id) . "&modal=1");
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
?>