<?php
    session_start();
    $suffix = isset($_SESSION["id"]) ? "Out" : "In";
?>

<!DOCTYPE html>
<html>
<head>
    <title>File uploader</title>
</head>
<body>
    <a href="views/userLogIn_view.php">Log <?= $suffix ?></a> ||
    <a href="views/userSignUp_view.php">Sign Up</a>
    <form action="../imgHandler/imgAdd.php" method="post" enctype="multipart/form-data">
        <input type="text" name="title" placeholder="title">
        <br>
        <input type="text" name="author" placeholder="author">
        <br>
        <input type="text" name="watermarkText" placeholder="watermark text" required>
        <br>
        <input type="file" name="img" required>
        <input type="submit">
    </form>

    <a href="views/imgGallery_view.php">Gallery</a>
</body>
</html>

<?php
