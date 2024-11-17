<?php
include '../../../config/database.php';

session_start();
if (!isset($_SESSION['contact'])) {
    header("Location: ../../../index.php");
    exit();
}

$contact = $_SESSION['contact'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $task = $_POST['task'];
    $id = $_POST['id'];

    $sql = "UPDATE todos SET task = ? WHERE id = ? AND user_contact = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sis", $task, $id, $contact);

    if ($stmt->execute()) {
        header("Location: ../../../src/user/todolist/editTodo.php?id=" . urlencode($id) . "&modal=1");
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }
    $stmt->close();
}

$conn->close();
?>