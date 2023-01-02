<?php

    function saveDataToDb($file, $name)
    {
        $img = createImage($file, $name);
        $img->save();
    }

    function createImage($file, $name)
    {
        $title = getTitle($file);
        $author = getAuthor();

        return new ImageData($title, $author, $name);
    }

    function getTitle($file)
    {
        if(isset($_POST['title']) && !empty($_POST['title']))
            return  $_POST['title'];
        else
            return pathinfo(basename($file['name']))["filename"];
    }

    function getAuthor()
    {
        if(isset($_POST['author']) && !empty($_POST['author']))
            return $_POST['author'];
        else
            return "unknown";
    }