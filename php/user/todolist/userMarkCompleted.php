<?php
include '../../../config/database.php';

session_start();
if (!isset($_SESSION['contact'])) {
    header("Location: ../../../index.php");
    exit();
}

if (isset($_GET['id'])) {
    $taskId = $_GET['id'];
    
    $sql = "SELECT completed FROM todos WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $taskId);
    $stmt->execute();
    $result = $stmt->get_result();
    $todo = $result->fetch_assoc();

    if ($todo) {
        $newStatus = $todo['completed'] ? 0 : 1;

        $updateSql = "UPDATE todos SET completed = ? WHERE id = ?";
        $updateStmt = $conn->prepare($updateSql);
        $updateStmt->bind_param("ii", $newStatus, $taskId);

        if ($updateStmt->execute()) {
            header("Location: ../../../src/user/todolist/todoList.php");
            exit();
        } else {
            echo "Error: " . $updateStmt->error;
        }
    } else {
        echo "Task not found.";
    }

    $stmt->close();
    $updateStmt->close();
} else {
    echo "Invalid request.";
}

$conn->close();
?>
