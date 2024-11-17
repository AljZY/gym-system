<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: ../../../admin.php");
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
            <h1>Add Announcement</h1>
            <a href="announcement.php" class="card-link">
                <span class="card-icon">
                <img src="../../../asset/icon/back.png" alt="Back" class="icon">
                </span>
            </a>
        </div>

        <form method="POST" action="../../../php/admin/announcement/addAnnouncement.php">
            <textarea name="announcement_text" placeholder="Enter your announcement..." required></textarea><br/>
            <button type="submit" class="green-button">Submit</button>
        </form>
    </div>

    <div id="myModal" class="modal">
        <div class="modal-content">
            <p>Announcement added successfully!</p>
            <button onclick="window.location.href='announcement.php'" class="blue-button">Go to Announcement</button>
            <button onclick="closeModal()" class="red-button">Close</button>
        </div>
    </div>

    <script src="../../../asset/javascript/adminAddAnnouncement.js"></script>
</body>
</html>
