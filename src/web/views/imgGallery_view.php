<?php
    require_once $_COOKIE["installPath"] . "/helperFunc.php";
    require_once getAbsPath("ImageData.php");

    define("uploadDir", getAbsPath("../upload/"));
    const htmlUploadDir = '/upload/thumb/';
    const thumbUploadDir = uploadDir.'thumb/';
    const paggingElementsCount = 2;

    $page = 0;
    if(isset($_GET["page"]))
        $page = $_GET["page"];


    echo '<a href="../index.php">Back to main menu</a> <br>';
    $imagesHtml = generateGallery();
    renderGallery($imagesHtml, $page);
    renderNextPrevButtons($page, count($imagesHtml)/paggingElementsCount);

    function generateGallery()
    {
        $imagesHtml = [];
        $images = ImageData::getAll();
        foreach ($images as $image)
        {
            $imgHtml = '<img src="'.htmlUploadDir.$image->name.'" /><br />';
            $imgHtml.= $image->title." | ".$image->author."<br>";
            $imagesHtml[] = $imgHtml;
        }
        return $imagesHtml;
    }
    function renderGallery($imagesHtml, $page)
    {
        for($i = $page*paggingElementsCount; $i < paggingElementsCount*($page+1) && $i < count($imagesHtml); $i++)
            echo $imagesHtml[$i];
    }

    function renderNextPrevButtons($page, $amountOfPages)
    {
        if($page > 0)
            echo '<a href="imgGallery_view.php?page='.($page-1).'">Previous</a>';
        if($page < $amountOfPages - 1)
            echo '<a href="imgGallery_view.php?page='.($page+1).'">Next</a>';
    }
?>
