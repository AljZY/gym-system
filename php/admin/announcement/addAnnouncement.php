<?php
include '../../../config/database.php';

session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: ../../../admin.php");
    exit();
}

$showModal = false;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $announcement_text = $_POST['announcement_text'];

    $sql = "INSERT INTO announcement (announcement_text) VALUES (?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $announcement_text);

    if ($stmt->execute()) {
        $showModal = true;
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}

header("Location: ../../../src/admin/announcement/addAnnouncement.php?modal=" . ($showModal ? "1" : "0"));

$conn->close();
?>