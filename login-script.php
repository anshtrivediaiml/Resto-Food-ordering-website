<?php
session_start();
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $conn->real_escape_string($_POST['username']);
    $password = $conn->real_escape_string($_POST['password']);

    $sql = "SELECT id FROM admins WHERE username = '$username' AND password = '$password'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Login success
        $_SESSION['login_user'] = $username;
        header("location: orders.php");
        exit();
    } else {
        // Login failed
        $_SESSION['error'] = "Your Username or Password is invalid";
        header("location: login.php");
        exit();
    }
}
?>