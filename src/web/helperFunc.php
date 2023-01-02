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
        // Idea: https://unixsheikh.com/tutorials/php-include-path-problems.html
        $installPathQuery = ["installPath" => ['$regex' => ".*"]];
        $installPath = DB::get()->paths->findOne($installPathQuery);

        if(empty($installPath))
        {
            $installPath = pathinfo(realpath(basename(getenv("SCRIPT_NAME"))))["dirname"];
            DB::get()->paths->insertOne(["installPath" => $installPath]);
        }

        return $installPath["installPath"];
    }

    function getAbsPath($relativePath)
    {
        return $_COOKIE["installPath"]."/".$relativePath;
    }