<!DOCTYPE html>
<html lang="en">
<?php
    $pdf_file = $_GET['pdf_file'];
?>
<title>國立中央大學防制霸凌專區</title>
 
<body>
    <?php include 'navbar.php';?>
    <div class="container">
        <main>
            <h1 style="text-align:center;">防制霸凌專區</h1>
            <h2 style="text-align:center;"><?php echo $pdf_file;?></h2>
            
            <div class="row" style="border: 0.5rem solid;">
                <embed src="./document/<?php echo $pdf_file;?>.pdf" 
                       width="1000%" 
                       height="700" 
                       title="<?php echo $pdf_file;?>" 
                       alt="<?php echo $pdf_file;?> PDF文件" 
                       pluginspage="http://www.adobe.com/products/acrobat/readstep2.html">
            </div>
        </main>
    </div>

    <?php include 'footer.php';?>
</body>

</html>