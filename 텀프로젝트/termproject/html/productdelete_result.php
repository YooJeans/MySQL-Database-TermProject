<?php 
     $con = mysqli_connect("172.20.10.9", "cookUser", "1234", "mydb") or die("MySQL 접속 실패!!");
 
     $product_barcode = $_POST["product_barcode"];
 
     $sql = "DELETE FROM product WHERE product_barcode='".$product_barcode."'";
 
     $ret = mysqli_query($con, $sql);
 
    echo "<H1>재고삭제 결과</H1>";
    if($ret) { 
    echo "재고가 성공적으로 삭제됨";
    } 
    else { 
       echo "데이터 삭제 실패!!!"."<BR>";
       echo "실패 원인 :".mysqli_error($con);
    } 
    mysqli_close($con);
 
    echo "<BR><BR> <A HREF='product.php'> 초기 화면</A> ";
 ?>
