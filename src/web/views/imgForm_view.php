<!DOCTYPE html>
<html>
<head>
    <title>File uploader</title>
</head>
<body>

    <form action="../imgSaver.php" method="post" enctype="multipart/form-data">
        <input type="text" name="watermarkText" placeholder="watermark text" required>
        <br>
        <input type="file" name="img" required>
        <input type="submit">
    </form>

</body>
</html>

<?php
