<?php
include '../../../config/database.php';

session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: ../../../admin.php");
    exit();
}

$sql = "SELECT * FROM announcement ORDER BY date_created DESC";
$result = $conn->query($sql);

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
                <a href="addAnnouncement.php" class="card-link">
                    <span class="card-icon">
                    <img src="../../../asset/icon/announcement.png" alt="Add Announcement" class="icon">
                    </span>    
                    Add Announcement
                </a>
            </div>
            <a  href="../homepage.php" class="card-link">
                <span class="card-icon">
                <img src="../../../asset/icon/back.png" alt="Back" class="icon">
                </span>
            </a>
        </div>

        <table class="three-cols">
            <thead>
                <tr>
                    <th>Date</th>
                    <th>Announcement</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        echo "<tr>
                                <td>" . $row['date_created'] . "</td>
                                <td>" . $row['announcement_text'] . "</td>
                                <td>
                                    <button onclick=\"window.location.href='editAnnouncement.php?id=" . $row['id'] . "'\" class=\"blue-button\">Edit</button>
                                    <button onclick=\"showDeleteModal(" . $row['id'] . ")\" class=\"red-button\">Delete</button>
                                </td>
                            </tr>";
                    }
                } else {
                    echo "<tr><td colspan='3'>No announcements found</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>

    <div id="deleteModal" class="modal">
        <div class="modal-content">
            <p>Are you sure you want to delete this Announcement?</p>
            <form id="deleteForm" method="POST" action="../../../php/admin/announcement/deleteAnnouncement.php">
                <input type="hidden" name="id" id="AnnouncementNoToDelete" />
                <button type="submit" class="blue-button">Confirm</button>
                <button type="button" onclick="closeDeleteModal()" class="red-button">Cancel</button>
            </form>
        </div>
    </div>

    <script src="../../../asset/javascript/adminDeleteAnnouncement.js"></script>
</body>
</html>
