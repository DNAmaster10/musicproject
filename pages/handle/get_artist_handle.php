<?php
    session_start();
    include $_SERVER["DOCUMENT_ROOT"]."/includes/dbh.php";
    include $_SERVER["DOCUMENT_ROOT"]."/includes/check_login.php";
    if (!$_SESSION["game_status"] == "yes") {
        echo "endgame";
        die();
    }
    if (!isset($_SESSION["attempts"])) {
        $_SESSION["attempts"] = 2;
    }
    
    $stmt = $conn->prepare("SELECT artist,song FROM songs ORDER BY RAND() LIMIT 1;");
    $stmt->execute();
    $result = $stmt->get_result();
    while ($row = $result->fetch_assoc()) {
        $song = $row["song"];
        $song_char = $song[0];
        $_SESSION["current_song"] = $song;
        $_SESSION["current_artist"] = $row["artist"];
        $return_string = $row["artist"]."#-#".$song_char;
    }
    echo $return_string;
?>