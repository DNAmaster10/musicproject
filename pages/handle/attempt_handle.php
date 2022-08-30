<?php
    session_start();
    include $_SERVER["DOCUMENT_ROOT"]."/includes/dbh.php";
    include $_SERVER["DOCUMENT_ROOT"]."/includes/check_login.php";

    $entered_song = $_GET["entered_song"];
    if (strtolower($_SESSION["current_song"]) == $entered_song && !$_SESSION["attempts"] == 1) {
        $_SESSION["attempts"] = $_SESSION["attempts"] - 1;
        $_SESSION["score"] = $_SESSION["score"] + 2;
        echo ("yes#-#".$_SESSION["current_artist"]."#-#".$_SESSION["current_song"]."#-#".strval($_SESSION["score"]));
        die();
    }
    else if (strtolower($_SESSION["current_song"]) == $entered_song) {
        unset ($_SESSION["attempts"]);
        $_SESSION["score"] = $_SESSION["score"] + 1;
        echo ("yes#-#".$_SESSION["current_artist"]."#-#".$_SESSION["current_song"]."#-#".strval($_SESSION["score"]));
        unset ($_SESSION["current_artist"]);
        unset ($_SESSION["current_song"]);
        die();
    }
    else {
        if ($_SESSION["attempts"] == 2) {
            $_SESSION["attempts"] = 1;
            echo ("no#-#no");
        }
        else {
            echo ("no#-#yes");
        }
    }
    
    
?>