<?php 
  include '../html/inc_head.php';
?>

<?php 
  include '../html/connect_to_mydb.php';
  include '../html/loadproductbarcode.php';
?>

<!DOCTYPE html>
<html>
  <head>    
    <link href="..\images\logo\small_logo.icon" rel="shortcut icon" type="image/x-icon">
    <title>CELEN</title>
    <style type="text/css">
      a { text-decoration:none } 
      a:link { color: black;} 
      a:visited { color: black;}  
      a:hover { color: green;}
      td { padding: 0.1px;}      
      .a { border-spacing: 0px;}
    </style>
    <meta http-equiv="content-type" content = "text/html" charset="utf-8" />
    <link href="\termproject\css\styles.css" rel="stylesheet" />
  </head>
  <body>
    <script type="text/javascript">
      function selectAll(selectAll){
        const checkboxes 
           = document.querySelectorAll('input[type="checkbox"]');
        checkboxes.forEach((checkbox) => {
          checkbox.checked = selectAll.checked})
      }
    </script>
  </body>
</html>

<?php
  date_default_timezone_set('Asia/Seoul');
  $cart_list_result = mysqli_query($con, 'SELECT * FROM cart') or die(mysqli_error($con));
  $costomer_id = $_SESSION['costomer_id'];
  $date = date("ymdHis");

  $cartlist = 
      mysqli_query($con,"SELECT * FROM cart C INNER JOIN product P
            ON C.product_barcode = P.product_barcode
              WHERE C.costomer_id='" .$costomer_id. "'") or die(mysqli_error($con));

      echo '<form action="gotoorder.php" method="POST">
            <table>
            <tr>
            <th><input type="checkbox" name="checkbox" value="selectall"
                 onclick="selectAll(this)"/> <b>전체 선택</b></th>
            <th>제품 이미지</th>
            <th>제품 이름</th>
            <th>사이즈</th>
            <th>수량</th>
            <th>가격</th>
            <th><input type="submit" value="주문하기"></th>        
            <tr>';
$i=0;
  while($row = mysqli_fetch_array($cart_list_result))
  {
    $row = mysqli_fetch_array($cartlist) or die(mysqli_error($con));
    if ($row['costomer_id'] == $costomer_id)
    {
      echo
        '<tr>
         <td>
         <input type="checkbox" id="checkbox" name="checked_product['.$i.']" 
          value="checked">';
      echo 
        '<input type="hidden" name="order_no[]" value='.$date.'>
         <input type="hidden" name="order_barcode[]" value="'.$row["product_barcode"].'">
         <input type="hidden" name="order_size[]" value="'.$row["product_size"].'">          
         <input type="hidden" name="number_of_order[]" value="'.$row["product_count"].'">
         <input type="hidden" name="costomer_no[]" value='.$_SESSION["costomer_id"].'>
         <input type="hidden" name="order_price[]" value='.$total_price = $row["price"] * $row["product_count"].''; 
      echo 
        '
          </td>
          <td>
            <div class="cart_products">
              <a href="../html/productinfo.php?product_name=', $row["product_name"],'"costomer_id="',   $_SESSION['costomer_id'],' target="home">
              <img src="'.$row['product_image_path'].'">
            </div>
          </td>
          <td>
            <div class="cart_products">
              <p>'.$row['product_name'].'</p>
            </div>
          </td>
          <td>
            <div class="cart_products">
              <p>'.$row['product_size'].'</p>
            </div>
          </td>
          <td>
            <div class="cart_products">
              <p>'.$row['product_count'].'</p>
            </div>
          </td>            
          <td>
            <div class="cart_products">
              <p class="price">'.$total_price.'</p>
            </div>
          </input>
          </td> 
          <td>
            <a href="../php/cart.php?action=delete&product_barcode=', $row["product_barcode"],'"costomer_id="',   $_SESSION['costomer_id'],'>
            <span class="text-danger">삭제</span></a>
          </td>  
          </tr>';    

        if($_GET["action"]=="delete") {               
          $sql = "DELETE FROM mydb.cart WHERE product_barcode='".$_GET['product_barcode']."'";    
          $ret = mysqli_query($con, $sql);
          if($ret) { 
            echo '<script>alert("삭제 되었습니다")</script>';
            echo '<script>window.location="../php/cart.php"</script>';
          } 
       }
      $i=$i+1;
    }
  }
  echo '</TABLE></form>';
?>


