function init() {
    document.getElementById("game_container").style.display = "none";
    document.getElementById("completed_container").style.display = "none";
    document.getElementById("final_result").style.display = "none";
}
function startGame() {
    console.log("Starting game...");
    $.ajax({
        url: "/pages/handle/start_game_handle.php",
        type: "GET",
        success: function(data) {
            if (data == "connected") {
                console.log("Started.");
                document.getElementById("game_container").style.display = "block";
                document.getElementById("completed_container").style.display = "block";
                document.getElementById("start_game_button").style.display = "none";
                document.getElementById("final_result").style.display = "none";
                getArtist();
            }
            else {
                console.log("Error occured connecting to server");
            }
            getArtist();
        }
    });
}
function getArtist() {
    console.log("Fetching new artist...");
    $.ajax({
        url: "/pages/handle/get_artist_handle.php",
        type: "GET",
        success: function(data) {
            var data_array = data.split("#-#");
            var artist = data_array[0];
            var song_char = data_array[1];
            document.getElementById("artist_name").innerHTML = "Artist: " + artist;
            document.getElementById("first_letter").innerHTML = "First letter of song: " + song_char;

        }
    });
}
function submitSong() {
    if (document.getElementById("song_input_box").value.length > 0) {
        var entered_song = document.getElementById("song_input_box").value;
        entered_song = entered_song.toLowerCase();
        $.ajax({
            url: "/pages/handle/attempt_handle.php",
            type: "GET",
            data: {
                entered_song: entered_song
            },
            success: function(data) {
                var data_array = data.split("#-#");
                if (data_array[0] == "yes") {
                    var artist = data_array[1];
                    var currentSong = data_array[2];
                    var score = data_array[3];

                    document.getElementById("artist_name").innerHTML = "Artist: ";
                    document.getElementById("first_letter").innerHTML = "First letter of song: ";
                    document.getElementById("song_input_box").value = "";
                    document.getElementById("attempts_left").innerHTML = "Attempts left: 2";
                    document.getElementById("completed_container").innerHTML += "\n" + artist + ", " + currentSong;
                    getArtist();
                }
                else if (data_array[0] == "no") {
                    if (data_array[1] == "no") {
                        document.getElementById("attempts_left").innerHTML = "Attempts left: 1";
                    }
                    else {
                        var score = data_array[2];
                        document.getElementById("artist_name") = "Artist: ";
                        document.getElementById("first_letter").innerHTML = "First letter of song: ";
                        document.getElementById("song_input_box").value = "";
                        document.getElementById("attempts_left").innerHTML = "Attempts left: 2";
                        document.getElementById("completed_container").innerHTML = "";
                        document.getElementById("game_container").style.display = "none";
                        document.getElementById("completed_container").style.display = "none";
                        document.getElementById("final_result").style.display = "block";
                        document.getElementById("start_game_button").style.display = "block";
                        document.getElementById("game_over_p").innerHTML = "Game over! You scored: " + score;
                    }
                }
            }
        });
    }
}
init();