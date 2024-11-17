<?php
include '../../../config/database.php';

session_start();
if (!isset($_SESSION['member_name'])) {
    header("Location: ../../../index.php");
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
            <h1>Announcements</h1>
            <a  href="../homepage.php" class="card-link">
                <span class="card-icon">
                <img src="../../../asset/icon/back.png" alt="Back" class="icon">
                </span>
            </a>
        </div>

        <table class="two-cols">
            <thead>
                <tr>
                    <th>Date</th>
                    <th>Announcement</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        echo "<tr>
                                <td>" . $row['date_created'] . "</td>
                                <td>" . $row['announcement_text'] . "</td>
                            </tr>";
                    }
                } else {
                    echo "<tr><td colspan='2'>No announcements found</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>
