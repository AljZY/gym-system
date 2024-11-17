<?php
include '../../../config/database.php';

session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: ../../../admin.php");
    exit();
}

$announcement_id = $_GET['id'];
$sql = "SELECT * FROM announcement WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $announcement_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $announcement = $result->fetch_assoc();
} else {
    echo "Announcement not found!";
    exit();
}
$stmt->close();
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
            <h1>Edit Announcement</h1>
            <a href="announcement.php" class="card-link">
                <span class="card-icon">
                <img src="../../../asset/icon/back.png" alt="Back" class="icon">
                </span>
            </a>
        </div>
        
        <form method="POST" action="../../../php/admin/announcement/editAnnouncement.php">

            <input type="hidden" name="announcement_id" value="<?php echo $announcement['id']; ?>" />
            <textarea name="announcement_text" required><?php echo $announcement['announcement_text']; ?></textarea><br/>
            <button type="submit" class="green-button">Update</button>
        </form>
    </div>

    <div id="myModal" class="modal">
        <div class="modal-content">
            <p>Announcement updated successfully!</p>
            <button onclick="window.location.href='announcement.php'" class="blue-button">Go to Inventory</button>
        </div>
    </div>

    <script src="../../../asset/javascript/adminEditAnnouncement.js"></script>
</body>
</html>
