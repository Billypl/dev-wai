<?php
    session_start();
    if(isset($_SESSION["id"]))
    {
        session_destroy();
        session_unset();
        header("Location: ../index.php");
        exit;
    }
    generateLoginLogMessage();

    function generateLoginLogMessage()
    {
        $log = "";
        if(isset($_SESSION["isCredentialsCorrect"]) && !$_SESSION["isCredentialsCorrect"])
            $log = "Wrong login or/and password";
        return $log;
    }
?>

<!DOCTYPE html>
<html>
<head>
    <title>File uploader</title>
</head>
<body>
    <form action="../userHandler/userLogIn.php" method="post">
        <input type="text" name="login" placeholder="login" required>
        <br>
        <input type="password" name="password" placeholder="password" required>
        <br>
        <input type="submit" value="Log In">
        <br>
        <p>
            <?= generateLoginLogMessage(); ?>
        </p>
    </form>

    <a href="userSignUp_view.php">Sign Up</a> ||
    <a href="../index.php">Main page</a>
</body>
</html>

<?php

    unset($_SESSION["isCredentialsCorrect"]);