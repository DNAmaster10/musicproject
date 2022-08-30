<?php
    session_start();
    include $_SERVER["DOCUMENT_ROOT"]."/includes/dbh.php";
    include $_SERVER["DOCUMENT_ROOT"]."/includes/check_login.php";

    $entered_song = $_GET["entered_song"];
    if (strtolower($_SESSION["current_song"]) == $entered_song && !$_SESSION["attempts"] == 1) {
        $_SESSION["attempts"] = $_SESSION["attempts"] - 1;
        $_SESSION["score"] = $_SESSION["score"] + 2;
        echo ("yes#-#".$_SESSION["current_artist"]."#-#".$_SESSION["current_song"]."#-#".strval($_SESSION["score"]."#-#".strval($_SESSION["attempts"])));
        die();
    }
    else if (strtolower($_SESSION["current_song"]) == $entered_song) {
        unset ($_SESSION["attempts"]);
        $_SESSION["score"] = $_SESSION["score"] + 1;
        echo ("yes#-#".$_SESSION["current_artist"]."#-#".$_SESSION["current_song"]."#-#".strval($_SESSION["score"]."#-#".strval($_SESSION["attempts"])));
        unset ($_SESSION["current_artist"]);
        unset ($_SESSION["current_song"]);
        die();
    }
    else {
        if ($_SESSION["attempts"] == 2) {
            $_SESSION["attempts"] = 1;
            echo ("no#-#no#-#".$_SESSION["score"]);
        }
        else {
            $stmt = $conn->prepare("SELECT highscore FROM users WHERE username=?");
            $stmt->bind_param("s", $_SESSION["username"]);
            $stmt->execute();
            $stmt->bind_result($result);
            $stmt->fetch();
            $stmt->close();
            if (!$result) {
                $stmt = $conn->prepare("UPDATE users SET highscore=?");
                $stmt->bind_param("i", $_SESSION["score"]);
                $stmt->execute();
                $stmt->close();
                $highscore = $_SESSION["score"];
            }
            else {
                if ($result < $_SESSION["score"]) {
                    $stmt = $conn->prepare("UPDATE user SET highscore=?");
                    $stmt->bind_param("i", $_SESSION["score"]);
                    $stmt->execute();
                    $stmt->close();
                    $highscore = $_SESSION["score"];
                }
                else {
                    $highscore = $result;
                }
            }
            $leaderboard_string = "#-#";
            $stmt = $conn->prepare("SELECT username,highscore FROM users ORDER BY highscore ASC LIMIT 5");
            $stmt->execute();
            $result = $stmt->get_result();
            while ($row = $result->fetch_assoc()) {
                $leaderboard_string = $leaderboard_string."<br>".$row["username"].": ".$row["highscore"];
            }
            echo ("no#-#yes#-#".$_SESSION["score"]."#-#".$highscore.$leaderboard_string);
        }
    }
    
    
?>