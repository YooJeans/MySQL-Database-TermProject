<?php 
  include 'connect_to_mydb.php';
?>

<!DOCTYPE html>

<html>
  <head>
    <title>CELEN</title>
    <meta http-equiv="content-type" content = "text/html" charset="utf-8">
    <link href="/termproject/css/styles.css" rel="stylesheet">
  </head>

  <body>
    <div class="navbar">
    </div>
    
    <img src="\termproject\images\logo\big_logo.png" style="display: block; margin: 0 auto; width:900px; height:450px;">
    <h1>skirt</h1>

    </div>
  </body>
</html>



<?php

  $list_result_select_skirt = 
  mysqli_query($con,
    "SELECT * 
      FROM product_barcode PB
        INNER JOIN product P
          ON PB.productbarcode = P.product_barcode
           WHERE PB.style='치마'") or die(mysqli_error($con));

  $i=0;
  while($i<91){
    $row = mysqli_fetch_array($list_result_select_skirt)or die(mysqli_error($con));
    if ($row['size'] == 'S'){
    echo     '<div class="products">
        <a href="productinfo.php?product_name=', $row["product_name"],'" target="home">
          <img src="'.$row['product_image_path'].'">
          <p>'.$row['product_name'].'</p>
          <p class="price">'.$row['price'].'</p>
        </a>
      </div>';

    }
    $i=$i-1;
  }

?>