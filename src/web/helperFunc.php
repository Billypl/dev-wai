<?php
    function printTab($tab)
    {
        for($i = 0; $i < strlen($tab); $i++)
        {
            $e = $tab[$i];
            if($e == '[')
                echo "<br> $e";
            else
                echo $e;
        }
    }

    function findInstallPath()
    {
        return  pathinfo(realpath(basename(getenv("SCRIPT_NAME"))))["dirname"];;
    }

    function getAbsPath($relativePath)
    {
        return $_COOKIE["installPath"]."/".$relativePath;
    }