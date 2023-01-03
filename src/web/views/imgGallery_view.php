<?php
    require_once $_COOKIE["installPath"] . "/helperFunc.php";
    require_once getAbsPath("/imgHandler/ImageData.php");

    define("uploadDir", getAbsPath("../upload/"));
    const htmlUploadDir = '/upload/thumb/';
    const thumbUploadDir = uploadDir.'thumb/';
    const paggingElementsCount = 2;

    $pageNr = 0;
    if(isset($_GET["page"]))
        $pageNr = $_GET["page"];


    echo '<a href="../index.php">Back to main menu</a> <br>';
    $imagesHtml = generateGallery();
    renderGallery($imagesHtml, $pageNr);
    renderNextPrevButtons($pageNr, count($imagesHtml)/paggingElementsCount);

    function generateGallery()
    {
        $imagesHtml = [];
        $images = ImageData::getAll();
        foreach ($images as $image)
        {
            $imgHtml = '<a href="/upload/watermark/'.$image->name.'">';
            $imgHtml.= '<img src="'.htmlUploadDir.$image->name.'" /><br />';
            $imgHtml.= '</a>';
            $imgHtml.= $image->title." | ".$image->author."<br>";
            $imagesHtml[] = $imgHtml;
        }
        return $imagesHtml;
    }
    function renderGallery($imagesHtml, $pageNr)
    {
        for($i = $pageNr*paggingElementsCount; $i < paggingElementsCount*($pageNr+1) && $i < count($imagesHtml); $i++)
            echo $imagesHtml[$i];
    }

    function renderNextPrevButtons($pageNr, $amountOfPages)
    {
        if($pageNr > 0)
            echo '<a href="imgGallery_view.php?page='.($pageNr-1).'">Previous</a>';
        if($pageNr < $amountOfPages - 1)
            echo '<a href="imgGallery_view.php?page='.($pageNr+1).'">Next</a>';
    }
?>
