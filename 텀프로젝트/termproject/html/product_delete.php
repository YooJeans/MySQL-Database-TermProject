<?php 
     $con = mysqli_connect("172.20.10.9", "cookUser", "1234", "mydb") or die("MySQL 접속 실패!!");
     $sql ="SELECT * FROM product WHERE product_barcode='".$_GET['product_barcode']."'";
 
     $ret = mysqli_query($con, $sql);
     if($ret) { 
     $count = mysqli_num_rows($ret);
     if($count==0) { 
       echo $_GET['product_barcode']." 해당 바코드의 제품이 없음!!!"."<BR>";
     echo "<BR> <A HREF='product.php'> 초기 화면</A> ";
     exit();
     } 
   } 
   else { 
     echo "데이터 검색 실패!!!"."<BR>";
     echo "실패 원인 :".mysqli_error($con);
     echo "<BR> <A HREF='product.php'> 초기 화면</A> ";
     exit();
   } 
   $row = mysqli_fetch_array($ret);
   $product_barcode = $row['product_barcode'];
   $product_name = $row["product_name"];

?> 

<HTML> 
<HEAD> 
	 <title>PRODUCT UPDATE</title>
     <META http-equiv="content-type" content="text/html; charset=utf-8"> 
     <link href="/termproject/css/styles.css" rel="stylesheet" />
</HEAD> 
<BODY>
<div style="text-align: center;">
<H1>재고 삭제</H1> 
<FORM METHOD="post" ACTION="productdelete_result.php"> 
 재고 번호 : <INPUT TYPE="text" NAME="product_barcode" VALUE=<?php echo $product_barcode ?> READONLY> <BR> 
 이름 : <INPUT TYPE="text" NAME="product_name" VALUE="<?php echo $product_name ?>" READONLY>     
    <BR> 
 <BR><BR> 
 위 재고을 삭제하겠습니까?
 <INPUT TYPE="submit" VALUE="재고 삭제"> 
</FORM> 
</div>
</BODY> 
</HTML>
