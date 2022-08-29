<?php
    session_start();
    if (isset($_SESSION["error"])) {
        $error = $_SESION["error"];
        unset($_SESSION["error"]);
    }
    else {
        $error = "An unknown error occured";
    }
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Error</title>
    </head>
    <body>
        <p id="error"><?php echo($error); ?></p>
        <form action="/index.php">
            <input type="submit" value="Home">
        </form>
    </body>
</html>