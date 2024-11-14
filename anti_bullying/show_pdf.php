<!DOCTYPE html>
<html lang="en">
<?php
    $pdf_file = $_GET['pdf_file'];
?>
 
<body>
    
  <?php include 'navbar.php';?>
  <div class="container">
    <!-- <div class="row">
      <embed src="./document/反霸凌流程圖.pdf" width="600" height="1200" alt="pdf" pluginspage="http://www.adobe.com/products/acrobat/readstep2.html">

    </div> -->
    <div class="row">
        <p></p>
    </div>
    <h1 style="text-align:center;"><?php echo $pdf_file;?></h1>
    <div class="row" style="border: 0.5rem solid;">
      <embed src="./document/<?php echo $pdf_file;?>.pdf" width="1000%" height="700" alt="pdf" pluginspage="http://www.adobe.com/products/acrobat/readstep2.html">

    </div>
    <div class="row">
        <p></p>
    </div>
  </div>

  <?php include 'footer.php';?>

</body>

</html>