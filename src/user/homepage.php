<?php
include '../../config/database.php';

session_start();
if (!isset($_SESSION['member_name'])) {
    header("Location: ../../index.php");
    exit();
}

$contact = $_SESSION['contact'];
$sql = "SELECT address, contact, plan, start_date, end_date, last_viewed_announcement FROM members WHERE contact = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $contact);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $member = $result->fetch_assoc();
} else {
    echo "Error fetching member details.";
    exit();
}

$last_viewed = $member['last_viewed_announcement'] ? $member['last_viewed_announcement'] : '2000-01-01 00:00:00';
$sql_new_announcements = "SELECT COUNT(*) AS new_count FROM announcement WHERE date_created > ?";
$stmt_new = $conn->prepare($sql_new_announcements);
$stmt_new->bind_param("s", $last_viewed);
$stmt_new->execute();
$result_new = $stmt_new->get_result();
$new_announcements_count = $result_new->fetch_assoc()['new_count'];

$sql_update_viewed = "UPDATE members SET last_viewed_announcement = NOW() WHERE contact = ?";
$stmt_update = $conn->prepare($sql_update_viewed);
$stmt_update->bind_param("s", $contact);
$stmt_update->execute();

$sql = "SELECT *, 
        DATEDIFF(end_date, CURDATE()) AS remaining_days 
        FROM members 
        WHERE contact = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $contact);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $member = $result->fetch_assoc();
} else {
    echo "Error fetching member details.";
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
    <link rel="stylesheet" href="../../asset/style.css">
</head>
<body>
    <div class="container">
        <div class="header">
            <div class="logo">
                Welcome! <?php echo htmlspecialchars($_SESSION['member_name']); ?>
            </div>
            <form method="GET" action="../../php/user/logout.php">
                <button type="submit" name="logout" class="logout-button">
                    <img src="../../asset/icon/logout.png" alt="Logout" class="icon">
                </button>
            </form>
        </div>
    
        <div class="cards-container">
            <div class="card">
                <a href="password/changePassword.php"  class="card-link">
                    <span class="card-icon">
                        <img src="../../asset/icon/key.png" alt="Change Password" class="icon">
                    </span>
                    Change Password
                </a>
            </div>
    
            <div class="card">
                <a href="todolist/todoList.php" class="card-link">
                    <span class="card-icon">
                    <img src="../../asset/icon/list.png" alt="Create Todo List" class="icon">
                    </span>    
                    Create Todo List
                </a>
            </div>
    
            <div class="card">
                <a href="announcement/announcement.php" class="card-link">
                    <span class="card-icon">
                    <img src="../../asset/icon/announcement.png" alt="Announcement" class="icon">
                    </span>    
                    Announcement
                    <?php if ($new_announcements_count > 0): ?>
                        <span class="notification">
                            <?php echo $new_announcements_count; ?>
                        </span>
                    <?php endif; ?>
                </a>
            </div>
        </div>
    
        <div class="details-container">
            <p><strong>Address:</strong> <?php echo htmlspecialchars($member['address']); ?></p>
            <p><strong>Contact:</strong> <?php echo htmlspecialchars($member['contact']); ?></p>
            <p><strong>Plan:</strong> <?php echo htmlspecialchars($member['plan']); ?></p>
            <p><strong>Start Date:</strong> <?php echo htmlspecialchars($member['start_date']); ?></p>
            <p><strong>End Date:</strong> <?php echo htmlspecialchars($member['end_date']); ?></p>
            <p><strong>Remaining Days:</strong> <?php echo htmlspecialchars($member['remaining_days']); ?></p>
        </div>

        
    </div>

    
</body>
</html>
