<?php 
  include '../html/connect_to_mydb.php';
  include '../html/loadproductbarcode.php';
?>

<?php 
  include '../html/inc_head.php';
?>

<?php
  $arrlist = $_POST['checked_product'];
  $order_list_result = mysqli_query($con, 'SELECT * FROM mydb.order') or die(mysqli_error($con));
  $costomer_id = $_SESSION['costomer_id'];
  
  $i = count($_POST['order_no']);
 
  for ($num=0; $num < $i; $num++) { 
    if ($_POST['checked_product'][$num]=="checked"){
      $sql = "INSERT INTO mydb.order VALUES ('".$_POST['order_no'][$num]."', 
             '".$_POST['order_barcode'][$num]."', '".$_POST['order_size'][$num]."', 
             ".$_POST['number_of_order'][$num].", '".$_POST['costomer_no'][$num]."', 
             ".$_POST['order_price'][$num].")";
      $ret = mysqli_query($con, $sql);
      if($ret) 
        echo '<script>alert("주문서추가완료")</script>';
      $sql2 = "DELETE FROM  mydb.cart WHERE product_barcode = '".$_POST['order_barcode'][$num]."'";
      $ret3 = mysqli_query($con, 'SELECT * FROM mydb.product');
      $row = mysqli_fetch_array($ret3);
      $sql3 = "UPDATE mydb.product SET number_of_product=".$row['number_of_product'] - $_POST['number_of_order'][$num].""WHERE product_barcode='".$_POST['order_barcode'][$num]."';
      print_r($sql3);
      $ret2 = mysqli_query($con, $sql2);
      echo '<script>window.location="../html/home.php"</script>';
    }
  }

 if ($_POST['checked_product'][$i]=="checked")
  $intoordertbl = 
    mysqli_query($con, "SELECT * FROM cart C INNER JOIN product P
                  ON C.product_barcode = P.product_barcode
                  WHERE C.costomer_id='" .$costomer_id. "'") or die(mysqli_error($con));
?>

<!DOCTYPE html>
<html>
  <head>    
    <link href="..\images\logo\small_logo.ico" rel="shortcut icon" type="image/x-icon">
    <title>CELEN</title>
    <style type="text/css">
      a { text-decoration:none } 
      a:link { color: black;} 
      a:visited { color: black;}  
      a:hover { color: green;}      
    </style>
    <meta http-equiv="content-type" content = "text/html" charset="utf-8" />
    <link href="\termproject\css\styles.css?d" rel="stylesheet" />
  </head>
  <body>
    <script type="text/javascript">
      $(document).ready(function() {
      $("input[name=checked_product]").each(function(index, item){
       alert($(item).attr("value1") + ", " + $(item).attr("value2"));
      });
    });
    </script>
  </body>
</html>
