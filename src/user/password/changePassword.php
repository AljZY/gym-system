<?php
session_start();
if (!isset($_SESSION['member_name'])) {
    header("Location: ../../../index.php");
    exit();
}

$error_message = '';
if (isset($_GET['error'])) {
    if ($_GET['error'] == 'incorrect_password') {
        $error_message = 'Current password is incorrect.';
    } elseif ($_GET['error'] == 'password_mismatch') {
        $error_message = 'New passwords do not match.';
    } elseif ($_GET['error'] == 'update_failed') {
        $error_message = 'Error updating password.';
    } elseif ($_GET['error'] == 'weak_password') {
        $error_message = 'Password must be at least 8 characters long, contain uppercase and lowercase letters, a number, and a symbol.';
    } elseif ($_GET['error'] == 'same_password') {
        $error_message = 'New password cannot be the same as the current password.';
    }
}

$current_password = isset($_SESSION['current_password']) ? $_SESSION['current_password'] : '';
$new_password = isset($_SESSION['new_password']) ? $_SESSION['new_password'] : '';
$confirm_password = isset($_SESSION['confirm_password']) ? $_SESSION['confirm_password'] : '';
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
            <h1>Change Password</h1>
            <a  href="../homepage.php" class="card-link">
                <span class="card-icon">
                <img src="../../../asset/icon/back.png" alt="Back" class="icon">
                </span>
            </a>
        </div>

        <form method="POST" action="../../../php/user/password/changePassword.php" onsubmit="return validatePassword()">

            <input type="password" name="current_password" placeholder="Current Password" required value="<?php echo htmlspecialchars($current_password); ?>" autocomplete="off"/>

            <input type="password" name="new_password" placeholder="New Password" required value="<?php echo htmlspecialchars($new_password); ?>" autocomplete="off"/>

            <input type="password" name="confirm_password" placeholder="Confirm Password" required value="<?php echo htmlspecialchars($confirm_password); ?>" autocomplete="off"/>

            <?php if ($error_message): ?>
                <p><?php echo htmlspecialchars($error_message); ?></p>
            <?php endif; ?>

            <button type="submit" class="green-button">Submit</button>

        </form>
    </div>

    <div id="successModal" class="modal">
        <div class="modal-content1">
            <p>Password changed successfully!</p>
            <button onclick="closeModal()" class="red-button">Close</button>
        </div>
    </div>

    <script src="../../../asset/javascript/userPasswordChange.js"></script>
</body>
</html>