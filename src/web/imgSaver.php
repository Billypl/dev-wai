<?php
    include_once "imgValidator.php";
    const uploadDir = '/var/www/dev/src/web/upload/';
    checkForIllegalDirectAccess();
    $file = $_FILES['img'];

    if(checkRequirements($file))
        saveFile($file);
    header("Location: sentFiles_view.php");

    function checkForIllegalDirectAccess()
    {
        if(isset($_FILES['img']))
            return;
        header("Location: index.php");
        exit;
    }
    function saveFile($file)
    {
        $filename = basename($file['name']);
        $target = uploadDir.$filename;
        $tmpPath = $file['tmp_name'];

        $success = move_uploaded_file($tmpPath, $target);
        setcookie("isFileSent", $success);
    }
