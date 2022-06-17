<?php
    session_start();
    include("../connection/connection.php");
    $username = $_SESSION['username'];
    $password = $_SESSION['password'];
    $nullvalue = "";
    $qrlogindelete = $conn->query("UPDATE users SET qrlogin='$nullvalue' WHERE username='$username' AND pass='$password';");
    session_destroy();
    header("Location: ../index.php");
?>