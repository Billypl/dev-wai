<?php
    const redirectIndex = "index.php";

    checkForIllegalDirectAccess();
    $errorsLog = generateFileUploadLogMessage();
    resetFileUploadCookies();

    function checkForIllegalDirectAccess()
    {
        if(!isset($_COOKIE["isFileSent"])       &&
            !isset($_COOKIE["isGoodFormat"])    &&
            !isset($_COOKIE["isGoodSize"]))
        {
            header("Location: ".redirectIndex);
            exit;
        }
    }

    function generateFileUploadLogMessage()
    {
        $errorsLog = "";
        if(isset($_COOKIE["isFileSent"]))
        {
            if($_COOKIE["isFileSent"])
                $errorsLog = "File successfully uploaded";
            else
                $errorsLog = "Server failed to save the file";
        }
        else
        {
            if(!$_COOKIE["isGoodFormat"])
                $errorsLog = $errorsLog."Wrong file format (accepted formats are: png/jpeg)!";
            if(!$_COOKIE["isGoodSize"])
                $errorsLog = $errorsLog."File exceeds 1MB!";
        }
        return $errorsLog;
    }
    function resetFileUploadCookies()
    {
        setcookie("isGoodFormat", "", time() - 3600, '/');
        setcookie("isGoodSize", "", time() - 3600, '/');
        setcookie("isFileSent", "",time() - 3600, '/');
    }
?>

<!DOCTYPE html>
<html>
<head>
    <title>Files uploaded</title>
</head>
<body>
    <?= $errorsLog ?>
    <br>
    <a href="../index.php">Send next one!</a>
</body>
</html>