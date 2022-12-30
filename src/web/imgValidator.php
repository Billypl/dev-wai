<?php
function checkRequirements($file)
{
    return checkForErrors($file) && validateParameters($file);
}
function checkForErrors($file)
{
    if($file["error"] != UPLOAD_ERR_OK)
    {
        setcookie("isGoodSize", 0);
        setcookie("isGoodFormat", 1);
        return false;
    }
    return true;
}
function validateParameters($file)
{
    setcookie("isGoodSize", checkSize($file));
    setcookie("isGoodFormat", checkFormat($file));
    return checkFormat($file) && checkSize($file);
}
function checkFormat($file)
{
    $finfo = finfo_open(FILEINFO_MIME_TYPE);
    $filename = $file['tmp_name'];
    $mimeType = finfo_file($finfo, $filename);

    return intval($mimeType === 'image/jpeg' || $mimeType === 'image/png');
}
function checkSize($file)
{
    return intval($file['size'] < 1000000);
}