<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: ../../admin.php");
    exit();
}
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
    <div class="header">
        <div class="logo" id="openModalBtn">
            Gym System
        </div>
        <form action="../../php/admin/logout.php" method="POST">
            <button type="submit" class="logout-button">
                <img src="../../asset/icon/logout.png" alt="Logout" class="icon">
            </button>
        </form>
    </div>

    <div class="cards-container">
        <div class="card">
            <a href="member/members.php" class="card-link">
                <span class="card-icon">
                <img src="../../asset/icon/member.png" alt="Member" class="icon">
                </span>    
                Membership
            </a>
        </div>

        <div class="card">
            <a href="payment/payment.php"class="card-link">
                <span class="card-icon">
                <img src="../../asset/icon/money.png" alt="Payment" class="icon">
                </span>    
                Payment
            </a>
        </div>

        <div class="card">
            <a href="inventory/inventory.php" class="card-link">
                <span class="card-icon">
                <img src="../../asset/icon/list.png" alt="Inventory" class="icon">
                </span>    
                Inventory
            </a>
        </div>

        <div class="card">
            <a  href="announcement/announcement.php" class="card-link">
                <span class="card-icon">
                <img src="../../asset/icon/announcement.png" alt="Announcement" class="icon">
                </span>    
                Announcement
            </a>
        </div>
    </div>

    <div id="simpleModal" class="modal">
        <div class="modal-content">
            <p>
                Admin Homepage
            </p><br/>
            <button class="red-button">Close</button>
        </div>
    </div>

    <script src="../../asset/javascript/modal.js"></script>
</body>
</html>
