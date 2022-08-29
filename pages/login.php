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
        <title>Login</title>
    </head>
    <body>
        <h1>Login</h1>
        <form action="/index.php">
            <input type="submit" value="Back">
        </form>
        <form action="/pages/login_submit.php" method="POST">
            <input type="text" name="username" placeholder="Username">
            <input type="text" name="password" placeholder="Password">
            <input type="submit" value="Login">
        </form>
        <p id="error_message"><?php if (isset($error)) { echo $error; } ?></p>
    </body>
</html>