<?php
    include_once "imgValidator.php";
    const uploadDir = '/var/www/dev/src/web/upload/';
    const imgUploadDir = uploadDir.'img/';
    const thumbUploadDir = uploadDir.'thumb/';
    const watermarkUploadDir = uploadDir.'watermark/';



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
        $tmpPath = $file['tmp_name'];
        saveImg($filename, $tmpPath);
        saveThumb($filename, $tmpPath);
    }

    function saveImg($filename, $tmpPath)
    {
        $target = imgUploadDir.$filename;
        $success = move_uploaded_file($tmpPath, $target);
        setcookie("isFileSent", $success);
    }

    function saveThumb($filename, $tmpPath)
    {
        $target = thumbUploadDir.$filename;
        $jpg_image = copyImage($filename);

        $thumb = imagescale($jpg_image, 200, 125);
        imagepng($thumb, $target,9);

    }

    function copyImage($filename)
    {
        $type = substr($filename,strrpos($filename,'.')+1);
        if($type == "jpeg" || $type == "jpg")
            return imagecreatefromjpeg(imgUploadDir.$filename);
        elseif ($type == "png")
            return imagecreatefrompng(imgUploadDir.$filename);
    }