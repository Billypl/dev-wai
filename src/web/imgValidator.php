<?php
function checkRequirements($file)
{
    return checkForErrors($file) && validateParameters($file);
}
function checkForErrors($file)
{
    if($file["error"] != UPLOAD_ERR_OK && $file["error"] != UPLOAD_ERR_INI_SIZE)
    {
        setcookie("isGoodSize", 0);
        setcookie("isGoodFormat", 1);
        return false;
    }
    return true;
}
function validateParameters($file)
{
    setcookie("isGoodSize", checkSize($file), time()+300, '/');
    setcookie("isGoodFormat", checkFormat($file), time()+300, '/');
    return checkFormat($file) && checkSize($file);
}
function checkFormat($file)
{
    $fInfo = finfo_open(FILEINFO_MIME_TYPE);
    $filename = $file['tmp_name'];
    $mimeType = finfo_file($fInfo, $filename);

    return intval($mimeType === 'image/jpeg' || $mimeType === 'image/png');
}
function checkSize($file)
{
    return intval($file['size'] < 1000000);
}