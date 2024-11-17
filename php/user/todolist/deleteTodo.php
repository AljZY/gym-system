<?php
include '../../../config/database.php';

session_start();
if (!isset($_SESSION['contact'])) {
    header("Location: ../../../index.php");
    exit();
}

if (isset($_POST['id'])) {
    $id = $_POST['id'];
    $contact = $_SESSION['contact'];

    $sql = "DELETE FROM todos WHERE id = ? AND user_contact = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("is", $id, $contact);

    if ($stmt->execute()) {
        header("Location: ../../../src/user/todolist/todoList.php?deleted=true");
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
} else {
    echo "No task ID provided!";
}

$conn->close();
?>
