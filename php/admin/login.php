<?php
include '../../config/database.php';

session_start();

$email = $_POST['email'];
$password = $_POST['password'];

$sql = "SELECT * FROM admin WHERE email='$email'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();

    if ($row['password'] === $password) {
        $_SESSION['admin'] = $email;
        header("Location: ../../src/admin/homepage.php");
        exit();
    } else {
        $error = "Wrong password";
        header("Location: ../../admin.php?error=" . urlencode($error) . "&email=" . urlencode($email) . "&password=" . urlencode($password));
        exit();
    }
} else {
    $error = "Wrong email";
    header("Location: ../../admin.php?error=" . urlencode($error) . "&email=" . urlencode($email) . "&password=" . urlencode($password));
    exit();
}

$conn->close();
?>