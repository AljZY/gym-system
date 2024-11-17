<?php
include '../../../config/database.php';

session_start();
if (!isset($_SESSION['member_name'])) {
    header("Location: ../../../index.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $current_password = $_POST['current_password'];
    $new_password = $_POST['new_password'];
    $confirm_password = $_POST['confirm_password'];

    $contact = $_SESSION['contact'];
    $sql = "SELECT temp_password FROM members WHERE contact = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $contact);
    $stmt->execute();
    $result = $stmt->get_result();
    $member = $result->fetch_assoc();

    $password_regex = '/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).{8,}$/';

    $_SESSION['current_password'] = $current_password;
    $_SESSION['new_password'] = $new_password;
    $_SESSION['confirm_password'] = $confirm_password;

    if (!$member || $current_password !== $member['temp_password']) {
        header("Location: ../../../src/user/password/changePassword.php?error=incorrect_password");
    } elseif ($new_password !== $confirm_password) {
        header("Location: ../../../src/user/password/changePassword.php?error=password_mismatch");
    } elseif ($new_password === $current_password) {
        header("Location: ../../../src/user/password/changePassword.php?error=same_password");
    } elseif (!preg_match($password_regex, $new_password)) {
        header("Location: ../../../src/user/password/changePassword.php?error=weak_password");
    } else {
        $update_sql = "UPDATE members SET temp_password = ? WHERE contact = ?";
        $update_stmt = $conn->prepare($update_sql);
        $update_stmt->bind_param("ss", $new_password, $contact);

        if ($update_stmt->execute()) {
            unset($_SESSION['current_password'], $_SESSION['new_password'], $_SESSION['confirm_password']);
            header("Location: ../../../src/user/password/changePassword.php?success=true");
        } else {
            header("Location: ../../../src/user/password/changePassword.php?error=update_failed");
        }
    }
}
$conn->close();
?>