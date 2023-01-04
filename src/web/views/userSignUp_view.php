<?php
    session_start();

    function generateLoginLogMessage()
    {
        $errorsLog = "";
        if(isset($_SESSION["isExistingAccount"]) && $_SESSION["isExistingAccount"])
            $errorsLog.= "Account with given login already exists!";
        if(isset($_SESSION["isPasswordMatching"]) && !$_SESSION["isPasswordMatching"])
            $errorsLog.= "Passwords don't match!";
        if(isset($_SESSION["isExistingAccount"]) && isset($_SESSION["isPasswordMatching"]) &&
            !$_SESSION["isExistingAccount"] && $_SESSION["isPasswordMatching"])
            $errorsLog = "Successfully created account";
        return $errorsLog;
    }

?>

<!DOCTYPE html>
<html>
<head>
    <title>File uploader</title>
</head>
<body>

    <form action="../userHandler/userAdd.php" method="post">
        <input type="text" name="email" placeholder="email" required>
        <br>
        <input type="text" name="login" placeholder="login" required>
        <br>
        <input type="password" name="password" placeholder="password" required>
        <br>
        <input type="password" name="passwordRepeated" placeholder="repeat password" required>
        <input type="submit" value="Sign Up">
        <br>
        <p>
            <?= generateLoginLogMessage(); ?>
        </p>
    </form>

    <a href="userLogIn_view.php">Log In</a> ||
    <a href="../index.php">Main page</a>
</body>
</html>

<?php
    unset($_SESSION["isExistingAccount"]);
    unset($_SESSION["isPasswordMatching"]);