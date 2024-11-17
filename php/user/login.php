<?php
include '../../config/database.php';

session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $contact = $conn->real_escape_string($_POST['contact']);
    $password = $conn->real_escape_string($_POST['password']);

    $sql = "SELECT * FROM members WHERE contact = '$contact' AND temp_password = '$password'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $member = $result->fetch_assoc();
        $_SESSION['member_name'] = $member['member_name'];
        $_SESSION['contact'] = $contact;
        header("Location: ../../src/user/homepage.php");
        exit();
    } else {
        $_SESSION['error'] = "Invalid phone number or password.";
        $_SESSION['contact'] = $contact;
        $_SESSION['password'] = $password;
        header("Location: ../../index.php");
        exit();
    }
}
