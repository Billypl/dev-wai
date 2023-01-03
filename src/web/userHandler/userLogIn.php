<?php
    session_start();
    require_once '../DB.php';

    if(!isset($_POST["login"]) || !isset($_POST["password"]))
        returnToLogInPage();

    if(!empty(getLoggedAccount()))
    {
        $user = getLoggedAccount();
        $_SESSION["login"] = $user["login"];
        $_SESSION["id"] = $user["id"];
        $_SESSION["isCredentialsCorrect"] = 1;
        header("Location: ../index.php");
        exit;
    }
    else
    {
        $_SESSION["isCredentialsCorrect"] = 0;
        returnToLogInPage();
    }

    function getLoggedAccount()
    {
        $query = [
            '$and' => [
                ['login' => $_POST["login"]],
                ['password' => $_POST["password"]]
            ]
        ];

        return DB::get()->users->findOne($query);
    }
    function returnToLogInPage()
    {
        header("Location: ../views/userLogIn_view.php");
        exit;
    }