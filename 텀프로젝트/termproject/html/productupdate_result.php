<?php 
  include 'connect_to_mydb.php';
?>

<?php 
 
     $product_barcode = $_POST["product_barcode"];
     $price = $_POST["price"];
     $number_of_product = $_POST["number_of_product"];
     $product_location = $_POST["product_location"];
     $product_name = $_POST["product_name"];
     $product_image_path = $_POST["product_image_path"];
     $sql ="UPDATE product SET price=".$price.",number_of_product=".$number_of_product;
     $sql = $sql.",product_location='".$product_location."',product_name='".$product_name."' WHERE product_name='".$product_name."'";
     $ret = mysqli_query($con, $sql);

 
   echo "<H1>재고 정보 수정 결과</H1>";
   if($ret) { 
     echo "데이터가 성공적으로 수정됨.";
 }
     else { 
        echo "데이터 수정 실패!!!"."<BR>";
        echo "실패 원인 :".mysqli_error($con);
     } 
     mysqli_close($con);
 
     echo "<BR> <A HREF='product.php'> 초기 화면</A> ";
?>
