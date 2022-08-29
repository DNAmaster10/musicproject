<?php
    $dbServername = "localhost";
    $dbUsername = "username";
    $dbPassword = "password";
    $dbName = "dbname";
    $conn = mysqli_connect($dbServername, $dbUsername, $dbPassword, $dbName);
    if (mysqli_connect_errno()) {
        echo "Failed to connect to MariaDB: " . mysqli_connect_error();
    }
?>