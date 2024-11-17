<?php
include '../../../config/database.php';

session_start();
if (!isset($_SESSION['contact'])) {
    header("Location: ../../../index.php");
    exit();
}

$contact = $_SESSION['contact'];

$sql = "SELECT * FROM todos WHERE user_contact = ? ORDER BY created_at DESC";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $contact);
$stmt->execute();
$result = $stmt->get_result();

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
    <div class="container">
        <div class="row1">
            <div class="card">
                <a href="addTodo.php" class="card-link">
                    <span class="card-icon">
                    <img src="../../../asset/icon/list.png" alt="Add Todo List" class="icon">
                    </span>    
                    Add Todo List
                </a>
            </div>
            <a  href="../homepage.php" class="card-link">
                <span class="card-icon">
                <img src="../../../asset/icon/back.png" alt="Back" class="icon">
                </span>
            </a>
        </div>

        <table class="four-cols">
            <thead>
                <tr>
                    <th>Task</th>
                    <th>Status</th>
                    <th>Created At</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($result->num_rows > 0): ?>
                    <?php while($todo = $result->fetch_assoc()): ?>
                        <tr>
                            <td>
                                <?php if ($todo['completed']): ?>
                                    <del><?php echo htmlspecialchars($todo['task']); ?></del>
                                <?php else: ?>
                                    <?php echo htmlspecialchars($todo['task']); ?>
                                <?php endif; ?>
                            </td>
                            <td>
                                <a href="../../../php/user/todolist/userMarkCompleted.php?id=<?php echo $todo['id']; ?>"
                                class="<?php echo $todo['completed'] ? 'green-button' : 'blue-button'; ?>">
                                    <?php echo $todo['completed'] ? 'Completed' : 'Pending'; ?>
                                </a>
                            </td>

                            <td><?php echo htmlspecialchars($todo['created_at']); ?></td>
                            <td>
                                <button onclick="window.location.href='editTodo.php?id=<?php echo $todo['id']; ?>'" class="blue-button">Edit</button>
                                <button onclick="showDeleteModal('<?php echo $todo['id']; ?>')" class="red-button">Delete</button>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="4"><div class="text">No tasks found.</div></td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

    <div id="deleteModal" class="modal">
        <div class="modal-content">
            <p>Are you sure you want to delete this task?</p>
            <form id="deleteForm" method="POST" action="../../../php/user/todolist/deleteTodo.php">
                <input type="hidden" name="id" id="listToDelete" />
                <button type="submit" class="blue-button">Confirm</button>
                <button type="button" onclick="closeDeleteModal()" class="red-button">Cancel</button>
            </form>
        </div>
    </div>

    <script src="../../../asset/javascript/userDeleteTodo.js"></script>
</body>
</html>
