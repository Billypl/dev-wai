<?php
    const uploadDir = 'upload/';
    const imgUploadDir = uploadDir.'img/';
    const thumbUploadDir = uploadDir.'thumb/';
    const watermarkUploadDir = uploadDir.'watermark/';
    const watermarkStampLocation = watermarkUploadDir.'stamp/watermark.png';
    function saveFile($file, $name)
    {
        $tmpPath = $file['tmp_name'];
        saveImg($name, $tmpPath);
        saveThumb($name);
        saveWatermark($name);
    }

    function saveImg($filename, $tmpPath)
    {
        $target = imgUploadDir.$filename;
        $success = move_uploaded_file($tmpPath, $target);
        setcookie("isFileSent", $success);
    }

    function saveThumb($filename)
    {
        $target = thumbUploadDir.$filename;
        $image = copyImage($filename);
        $thumb = imagescale($image, 200, 125);
        imagepng($thumb, $target,9);

        imagedestroy($image);
        imagedestroy($thumb);
    }

    function saveWatermark($filename)
    {
        $target = watermarkUploadDir.$filename;

        $image = copyImage($filename);
        $watermark = applyWatermarkFromText($filename);
        imagepng($watermark, $target);

        imagedestroy($image);
        imagedestroy($watermark);
    }

    function copyImage($filename)
    {
        $type = substr($filename,strrpos($filename,'.') + 1);
        if($type == "jpeg" || $type == "jpg")
            return imagecreatefromjpeg(imgUploadDir.$filename);
        else
            return imagecreatefrompng(imgUploadDir.$filename);
    }

    function applyWatermarkFromImage($filename)
    {
        $stamp = imagecreatefrompng(watermarkStampLocation);
        $image = copyImage($filename);

        // Set the margins for the stamp and get the height/width of the stamp image
        $marge_right = 10;
        $marge_bottom = 10;
        $sx = imagesx($stamp);
        $sy = imagesy($stamp);

        imagecopy($image, $stamp,
            imagesx($image) - $sx - $marge_right,
            imagesy($image) - $sy - $marge_bottom,
            0, 0, imagesx($stamp), imagesy($stamp));

        imagedestroy($stamp);
        return $image;
    }
    function applyWatermarkFromText($filename)
    {
        global $watermarkText;
        $image = copyImage($filename);
        $white =  imagecolorallocate($image, 255, 255, 255);

        for($i = 0; $i < imagesx($image); $i+=strlen($watermarkText)*10+50)
            for($j = 0; $j < imagesy($image); $j+=50)
                imagestring($image, 5, $i, $j, $watermarkText, $white);

        return $image;
    }