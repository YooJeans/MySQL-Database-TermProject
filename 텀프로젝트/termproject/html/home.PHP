<?php 
  include 'inc_head.php';
?>

<?php 
  include 'connect_to_mydb.php';
?>

<!DOCTYPE html>

<html>
  <head>

    <title>CELEN</title>
    <meta http-equiv="content-type" content = "text/html" charset="utf-8">
    <link href="..\css\styles.css" rel="stylesheet">
  </head>

  <body>
    <div class="navbar"> </div>
    <img src="\termproject\images\logo\big_logo.png" style="display: block; margin: 0 auto; width:900px; height:450px;">
    <h1>All Products</h1>
  </body>
</html>

<?php

  $list_result = mysqli_query($con, 'SELECT * FROM product') or die(mysqli_error($con));
  $list_result_size = mysqli_query($con, 'SELECT * FROM product_barcode') or die(mysqli_error($con));

  $list_result_select_products = 
  mysqli_query($con,
    "SELECT * 
      FROM product_barcode PB
        INNER JOIN product P
          ON PB.productbarcode = P.product_barcode
           WHERE PB.size='S'") or die(mysqli_error($con));


  while($row = mysqli_fetch_array($list_result))
  {
    $row = mysqli_fetch_array($list_result_select_products) or die(mysqli_error($con));
    if ($row['size'] == 'S')
    {
      echo     
          '<div class="products">
            <a href="productinfo.php?product_name=', $row["product_name"],'"costomer_id="',   $_SESSION['costomer_id'],' target="home">
              <img src="'.$row['product_image_path'].'">
              <p>'.$row['product_name'].'</p>
              <p class="price">'.$row['price'].'</p>
            </a>
          </div>';
    }
  }
?>