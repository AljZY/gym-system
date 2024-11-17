<?php
session_start();
if (!isset($_SESSION['contact'])) {
    header("Location: ../../../index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gym System</title>
    <link rel="stylesheet" href="../../../asset/style.css">
</head>
<body>
    <div class="add-container">
        <div class="row1">
            <h1>Add Todo List</h1>
            <a href="todoList.php" class="card-link">
                <span class="card-icon">
                <img src="../../../asset/icon/back.png" alt="Back" class="icon">
                </span>
            </a>
        </div>

        <form method="POST" action="../../../php/user/todolist/addTodo.php">
            <input type="text" name="task" placeholder="Add Task" required autocomplete="off">
            <button type="submit" class="green-button">Add</button>
        </form>
    </div>

    <div id="myModal" class="modal">
        <div class="modal-content">
            <p>List added successfully!</p>
            <button onclick="window.location.href='todoList.php'" class="blue-button">Go to List</button>
            <button onclick="closeModal()" class="red-button">Close</button>
        </div>
    </div>

    <script src="../../../asset/javascript/userAddTodo.js"></script>
</body>
</html>
