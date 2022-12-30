<?php
    const redirectIndex = "index.php";

    checkForIllegalDirectAccess();
    $log = generateFileUploadLogMessage();
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
        $log = "";
        if(isset($_COOKIE["isFileSent"]))
        {
            if($_COOKIE["isFileSent"])
                $log = "File successfully uploaded";
            else
                $log = "Server failed to save the file";
        }
        else
        {
            if(!$_COOKIE["isGoodFormat"])
                $log = $log."Wrong file format (accepted formats are: png/jpeg)!";
            elseif(!$_COOKIE["isGoodSize"])
                $log = $log."File exceeds 1MB!";
        }
        return $log;
    }
    function resetFileUploadCookies()
    {
        setcookie("isGoodFormat", false);
        setcookie("isGoodSize", false);
        setcookie("isFileSent", false);
    }
?>

<!DOCTYPE html>
<html>
<head>
    <title>Files uploaded</title>
</head>
<body>
<?= $log ?>
<form action="../index.php">
    <input type="submit" value="Send next one!">
</form>

</body>
</html>