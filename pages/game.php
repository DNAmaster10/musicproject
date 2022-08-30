<?php
    session_start();
    include $_SERVER["DOCUMENT_ROOT"]."/includes/dbh.php";
    include $_SERVER["DOCUMENT_ROOT"]."/includes/check_login.php";
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Game</title>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    </head>
    <body>
        <h1>Music game</h1>
        <form action="/index.php">
            <input type="submit" value="Home">
        </form>
        <button type="button" onclick="startGame()" id="start_game_button">Start game</button>
        <div id="game_container">
            <p id="artist_name">Artist: </p>
            <p id="first_letter">First letter of song: </p>
            <input type="text" id="song_input_box" placeholder="song name">
            <button type="button" onclick="submitSong()" id="submit_song_button">Submit</button>
            <p id="attempts_left">Attempts left: 2</p>
            <p id="points">Score: </p>
        </div>
        <div id="completed_container">
            <p id="points">Score: 0</p>
            <p id="completed_songs"></p>
        </div>
        <div id="final_result">
            <p id="game_over_p">Game over! You scored: 0</p>
            <p id="leaderboard"></p>
        </div>
    </body>
    <script src="/pages/game.js"></script>
</html>