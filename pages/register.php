<?php
    session_start();
    if (isset($_SESSION["error"])) {
        $error = $_SESSION["error"];
        unset($_SESSION["error"]);
    }
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Register</title>
    </head>
    <body>
        <h1>Register</h1>
        <form action="/index.php">
            <input type="submit" value="Back">
        </form>
        <form action="/pages/register_submit.php" method="POST">
            <input type="text" name="username" placeholder="username">
            <input type="text" name="password" placeholder="password">
            <input type="submit" value="Register">
        </form>
        <p id="error_message"><?php if (isset($error)) { echo $error; } ?></p>
    </body>
</html>