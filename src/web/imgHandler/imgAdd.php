<?php

    require_once $_COOKIE["installPath"] . "/helperFunc.php";
    require_once getAbsPath("imgHandler/ImageData.php");
    require_once getAbsPath("imgHandler/imgValidator.php");
    require_once getAbsPath("imgHandler/imgFileSaver.php");
    require_once getAbsPath("imgHandler/imgDataSaver.php");

    const redirectFinalScreenPath = "../views/sentFiles_view.php";
    const redirectIndex = "../index.php";

    $watermarkText = $_POST['watermarkText'];

    checkForIllegalDirectAccess();
    $file = $_FILES['img'];

    if(checkRequirements($file))
    {
        $timestamp = strtotime("now");
        $pathInfo = pathinfo(basename($file['name']));
        $name = $pathInfo['filename'].$timestamp.'.'.$pathInfo['extension'];

        saveDataToDb($file, $name);
        saveFile($file, $name);
    }
    header("Location: ".redirectFinalScreenPath);

    function checkForIllegalDirectAccess()
    {
        if(isset($_FILES['img']))
            return;
        header("Location: ".redirectIndex);
        exit;
    }
