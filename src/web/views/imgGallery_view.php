<?php
    const uploadDir = '../upload/';
    const htmlUploadDir = '/upload/thumb/';
    const thumbUploadDir = uploadDir.'thumb/';
    const paggingElementsCount = 2;

    $page = 0;
    if(isset($_GET["page"]))
        $page = $_GET["page"];

    echo '<a href="../index.php">Back to main menu</a> <br>';
    $imagesHtml = generateImages();
    renderImages($imagesHtml, $page);
    generateNextPrevButtons($page, count($imagesHtml)/paggingElementsCount);

    function generateImages()
    {
        $images = glob(thumbUploadDir."*.*");
        $imagesHtml = [];
        foreach($images as $image)
        {
            $filename = pathinfo($image)['basename'];
            $imagesHtml[] = '<img src="'.htmlUploadDir.$filename.'" /><br />';
        }
        return $imagesHtml;
    }

    function renderImages($imagesHtml, $page)
    {
        for($i = $page*paggingElementsCount; $i < paggingElementsCount*($page+1) && $i < count($imagesHtml); $i++)
            echo $imagesHtml[$i];
    }

    function generateNextPrevButtons($page, $amountOfPages)
    {
        if($page > 0)
            echo '<a href="imgGallery_view.php?page='.($page-1).'">Previous</a>';
        if($page < $amountOfPages - 1)
            echo '<a href="imgGallery_view.php?page='.($page+1).'">Next</a>';
    }
?>
