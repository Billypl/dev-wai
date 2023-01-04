<?php
    require_once $_COOKIE["installPath"] . "/helperFunc.php";
    require_once getAbsPath("DB.php");
    require_once getAbsPath("userHandler/User.php");
    session_start();

    comparePasswordFields();
    checkForExistingAccount();
    if($_SESSION["isPasswordMatching"] && !$_SESSION["isExistingAccount"])
    {
        $hashedPass =  password_hash($_POST["password"], PASSWORD_DEFAULT);
        $user = new User($_POST["login"], $_POST["email"], $hashedPass, false);
        $user->saveToDb();
    }
    returnToLoginForm();



    function comparePasswordFields()
    {
        $_SESSION["isPasswordMatching"] = intval($_POST["password"] == $_POST["passwordRepeated"]);
    }
    function checkForExistingAccount()
    {
        $existingLogin = DB::get()->users->findOne(["login" => $_POST["login"]]);
        $_SESSION["isExistingAccount"] = intval(!empty($existingLogin));
    }
    function returnToLoginForm()
    {
        header("Location: ../views/userSignUp_view.php");
        exit;
    }