<?php
    include_once "imgValidator.php";
    require_once "imgSaver.php";
    require_once "Image.php";

    const redirectFinalScreenPath = "views/sentFiles_view.php";
    const redirectIndex = "index.php";

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

     function saveDataToDb($file, $name)
     {
         $img = createImage($file, $name);
         $img->save();
     }

     function createImage($file, $name)
     {
         $title = getTitle($file);
         $author = getAuthor();

         return new Image($title, $author, $name);
     }

    function getTitle($file)
    {
        if(isset($_POST['title']) && !empty($_POST['title']))
            return  $_POST['title'];
        else
            return pathinfo(basename($file['name']))["filename"];
    }

    function getAuthor()
    {
        if(isset($_POST['author']) && !empty($_POST['author']))
            return $_POST['author'];
        else
            return "unknown";
    }