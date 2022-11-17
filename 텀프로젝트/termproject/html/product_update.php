<?php 
    $con = mysqli_connect("172.20.10.9", "cookUser", "1234", "mydb") or die("MySQL 접속 실패!!");
    $sql = "SELECT * FROM product WHERE product_barcode='".$_GET['product_barcode']."'";
    $ret = mysqli_query($con, $sql);
    if($ret) { 
       $count = mysqli_num_rows($ret);
       if($count==0) { 
         echo $_GET['product_barcode']." 해당 바코드를 가진 재고가 없음!!!"."<BR>";
         echo "<BR> <A HREF='product.php'> 이전 화면</A> ";
         exit();
        } 
    } 
    else { 
         echo "데이터 검색 실패!!!"."<BR>";
         echo "실패 원인 :".mysqli_error($con);
         echo "<BR> <A HREF='product.php'> 이전 화면</A> ";
         exit();
    } 
    $row = mysqli_fetch_array($ret);
    $product_barcode = $row['product_barcode'];
    $price = $row['price'];
    $number_of_product = $row['number_of_product'];
    $product_location = $row['product_location'];
    $product_name = $row['product_name'];
    $product_image_path = $row['product_image_path'];
?> 

<HTML> 
<HEAD> 
 <title>PRODUCT UPDATE</title>
 <META http-equiv="content-type" content="text/html; charset=utf-8"> 
 <link href="/termproject/css/styles.css" rel="stylesheet" />
</HEAD> 
<BODY> 

 <H1>재고 정보 수정</H1> 
<div style="text-align: center;">
<FORM METHOD="post" ACTION="productupdate_result.php"> 
     재고 번호 : <INPUT TYPE="text" NAME="product_barcode" VALUE=<?php echo $product_barcode ?> READONLY> <BR> 
     가격 : <INPUT TYPE="text" NAME="price" VALUE=<?php echo $price ?>> <BR> 
     수량 : <INPUT TYPE="text" NAME="number_of_product" VALUE=<?php echo $number_of_product ?>> <BR> 
     재고 위치 : <INPUT TYPE="text" NAME="product_location" VALUE=<?php echo $product_location ?> READONLY> <BR>
     재고 이름 : <INPUT TYPE="text" NAME="product_name" VALUE="<?php echo $product_name ?>"> <BR> 
     이미지 경로 : <INPUT TYPE="text" NAME="product_image_path" VALUE=<?php echo $product_image_path ?> READONLY> <BR> 
     <BR><BR> 
     <INPUT TYPE="submit" VALUE="정보 수정"> 
</FORM>
</div> 
</BODY> 
</HTML>