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
?>