<?php
    session_start();
    require_once '../DB.php';

    if(checkForIllegalAccess())
        returnToLogInPage();

    if(isDataValid())
    {
        $user = getLoggedAccount();
        $_SESSION["login"] = $user["login"];
        $_SESSION["id"] = $user["id"];
        $_SESSION["isCredentialsCorrect"] = 1;
        header("Location: ../views/userLogInSuccess_view.php");
        exit;
    }
    else
    {
        $_SESSION["isCredentialsCorrect"] = 0;
        returnToLogInPage();
    }


    function checkForIllegalAccess()
    {
        return !isset($_POST["login"]) || !isset($_POST["password"]);
    }
    function returnToLogInPage()
    {
        header("Location: ../views/userLogIn_view.php");
        exit;
    }
    function isDataValid()
    {
        return !empty(getLoggedAccount());
    }
    function getLoggedAccount()
    {
        $query = ['login' => $_POST["login"]];
        $acc = DB::get()->users->findOne($query);
        if(password_verify($_POST["password"], $acc['password']))
            return $acc;
        return "";
    }



