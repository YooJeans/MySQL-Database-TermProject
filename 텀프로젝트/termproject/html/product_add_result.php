<?php 
     $con = mysqli_connect("172.20.10.9", "cookUser", "1234", "mydb") or die("MySQL 접속 실패!!");

     $product_barcode = $_POST["product_barcode"];
     $price = $_POST["price"];
     $number_of_product = $_POST["number_of_product"];
     $product_location = $_POST["product_location"];
     $product_name = $_POST["product_name"];
     $product_image_path = $_POST["product_image_path"];
  
   $sql =" INSERT INTO product VALUES (".$product_barcode.", '".$price."','".$number_of_product;
   $sql = $sql."','".$product_location."','".$product_name."','".$product_image_path."')";
 
   $ret = mysqli_query($con, $sql);
 
   echo "<H1>재고 입력 결과</H1>";
   if($ret) { 
     echo "데이터가 성공적으로 입력됨.";
   } 
   else { 
    echo "데이터 입력 실패!!!"."<BR>";
    echo "실패 원인 :".mysqli_error($con);
   } 
   mysqli_close($con);
 
   echo "<BR> <A HREF='admin2.html'> 초기 화면</A> ";
?>

<HTML> 
<HEAD> 
    <title>ADD PRODUCT RESULT</title>
</HEAD>
</HTML>