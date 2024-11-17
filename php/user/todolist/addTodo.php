<?php
include '../../../config/database.php';

session_start();
if (!isset($_SESSION['contact'])) {
    header("Location: ../../../index.php");
    exit();
}

$showModal = false;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $contact = $_SESSION['contact'];
    $task = $_POST['task'];

    $sql = "INSERT INTO todos (user_contact, task) VALUES (?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $contact, $task);

    if ($stmt->execute()) {
        $showModal = true;
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}

header("Location: ../../../src/user/todolist/addTodo.php?modal=" . ($showModal ? "1" : "0"));

$conn->close();
?>