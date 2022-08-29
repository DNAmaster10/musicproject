<?php
    session_start();
    include $_SERVER["DOCUMENT_ROOT"]."/includes/dbh.php";

    if (!isset($_SESSION["username"]) || !isset($_SESSION["password"])) {
        $_SESSION["error"] = "Your session has expired.";
        header ("Location: /pages/generic-error.php");
        die();
    }
    $username = $_SESSION["username"];
    $password = $_SESSION["password"];

    $stmt = $conn->prepare("SELECT password FROM users WHERE username=?");

    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->bind_result($result);
    $stmt->fetch();
    $stmt->close();
    if (!$result) {
        $_SESSION["error"] = "Invalid login!";
        header ("Location: /pages/generic-error.php");
        die();
    }
    if (!$result == $password) {
        $_SESSION["error"] = "Invalid password";
        header ("Location: /pages/generic-error.php");
        die();
    }
?>