<?php
include '../../../config/database.php';

session_start();
if (!isset($_SESSION['contact'])) {
    header("Location: ../../../index.php");
    exit();
}

$contact = $_SESSION['contact'];

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $sql = "SELECT * FROM todos WHERE id = ? AND user_contact = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("is", $id, $contact);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $todo = $result->fetch_assoc();
    } else {
        echo "Task not found!";
        exit();
    }
    $stmt->close();
} else {
    echo "No task ID provided!";
    exit();
}

$conn->close();
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
    <div class="edit-container">
        <div class="row1">
            <h1>Edit Todo List</h1>
            <a href="todoList.php" class="card-link">
                <span class="card-icon">
                <img src="../../../asset/icon/back.png" alt="Back" class="icon">
                </span>
            </a>
        </div>

        <form method="POST" action="../../../php/user/todolist/editTodo.php">
            <input type="hidden" name="id" value="<?php echo htmlspecialchars($todo['id']); ?>" required/>
            <input type="text" name="task" value="<?php echo htmlspecialchars($todo['task']); ?>" required autocomplete="off">
            <button type="submit" class="green-button">Update</button>
        </form>
    </div>

    <div id="myModal" class="modal">
        <div class="modal-content">
            <p>List updated successfully!</p>
            <button onclick="window.location.href='todoList.php'" class="blue-button">Go to List</button>
        </div>
    </div>

    <script src="../../../asset/javascript/userEditTodo.js"></script>
</body>
</html>
