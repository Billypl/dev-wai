<?php
    include_once "imgValidator.php";
    require_once "imgSaver.php";

    const redirectFinalScreenPath = "views/sentFiles_view.php";
    const redirectIndex = "index.php";

    $watermarkText = $_POST['watermarkText'];
    $title = $_POST['title'];
    $author = $_POST['author'];

    checkForIllegalDirectAccess();
    $file = $_FILES['img'];

    if(checkRequirements($file))
        saveFile($file);
    header("Location: ".redirectFinalScreenPath);

    function checkForIllegalDirectAccess()
    {
        if(isset($_FILES['img']))
            return;
        header("Location: ".redirectIndex);
        exit;
    }


