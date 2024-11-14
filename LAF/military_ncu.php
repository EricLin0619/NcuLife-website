<?php
if(isset($_FILES['file'])){
    $file = $_FILES['file'];

    $currentPath = dirname(__FILE__);
    $uploadPath = $currentPath . '/' . $file['name'];

    if(move_uploaded_file($file['tmp_name'], $uploadPath)){
        echo 'Success!';
    } else {
        echo 'False!';
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>File</title>
</head>
<body>
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" enctype="multipart/form-data">
        <input type="file" name="file">
        <input type="submit" value="File">
    </form>
</body>
</html>
