<?php
    session_start();
    include $_SERVER["DOCUMENT_ROOT"]."/includes/dbh.php";
    if (!isset($_POST["username"])) {
        $_SESSION["error"] = "Please enter a username";
        header ("Location: /pages/register.php");
        die();
    }
    if (!isset($_POST["password"])) {
        $_SESSION["error"] = "Please enter a password";
        header ("Location: /pages/register.php");
        die();
    }
    $username = $conn->real_escape_string($_POST["username"]);
    $password = $conn->real_escape_string($_POST["password"]);

    $stmt = $conn->prepare("INSERT INTO users (username, password) VALUES (?,?);");
    $stmt->bind_param("ss", $username, $password);
    $stmt->execute();
    $stmt->close();
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Done!</title>
    </head>
    <body>
        <h1>All done!</h1>
        <p>Your account has successfully been registered, <?php echo $username; ?></p>
        <form action="/index.php">
            <input type="submit" value="Home">
        </form>
    </body>
</html>