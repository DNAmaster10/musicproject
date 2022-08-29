<?php
    session_start();
    if (!isset($_POST["username"])) {
        $_SESSION["error"] = "Please enter a username";
        header ("Location: /pages/login.php");
        die();
    }
    if (!isset($_POST["password"])) {
        $_SESSION["error"] = "Please enter a password";
        header ("Location: /pages/login.php");
        die();
    }

    $username = $conn->real_escape_string($_POST["username"]);
    $password = $conn->real_escape_string($_POST["password"]);

    $stmt = $conn->prepare("SELECT password FROM users WHERE username=?;");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->bind_result($result);
    $stmt->fetch();
    $stmt->close();
    if ($result == $password) {
        $_SESSION["username"] = $username;
        $_SESSION["password"] = $password;
        header ("Location: /pages/game.php");
        die();
    }
    else {
        $_SESSION["error"] = "Login details invalid.";
        header ("Location: /pages/login.php");
        die();
    }
?>