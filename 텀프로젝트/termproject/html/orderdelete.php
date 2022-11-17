<?php 
     $con = mysqli_connect("172.20.10.9", "cookUser", "1234", "mydb") or die("MySQL 접속 실패!!");
     $sql ="SELECT * FROM mydb.order WHERE order_barcode='".$_GET['order_barcode']."'";
 
     $ret = mysqli_query($con, $sql);
     if($ret) { 
     $count = mysqli_num_rows($ret);
     if($count==0) { 
       echo $_GET['order_barcode']." 해당 상품이 없음!!!"."<BR>";
     echo "<BR> <A HREF='myorderpage.php'> 주문서 화면</A> ";
     exit();
     } 
   } 
   else { 
     echo "데이터 검색 실패!!!"."<BR>";
     echo "실패 원인 :".mysqli_error($con);
     echo "<BR> <A HREF='myorderpage.php'> 주문서 화면</A> ";
     exit();
   } 
   $row = mysqli_fetch_array($ret);
   $order_barcode = $row['order_barcode'];

?> 

<HTML> 
<HEAD> 
   <title>ORDER DELETE</title>
     <META http-equiv="content-type" content="text/html; charset=utf-8">
     <link href="..\images\logo\small_logo.ico" rel="shortcut icon" type="image/x-icon">
     <link href="/termproject/css/styles.css" rel="stylesheet" />
     
</HEAD> 
<BODY>
<div style="text-align: center;">
<H1>주문 삭제</H1> 
<FORM METHOD="post" ACTION="orderdelete_result.php"> 
 상품 바코드 : <INPUT TYPE="text" NAME="order_barcode" VALUE=<?php echo $order_barcode ?> READONLY> <BR> 
 <BR><BR> 
 위 상품을 삭제하겠습니까?
 <INPUT TYPE="submit" VALUE="상품 삭제"> 
</FORM> 
</div>
</BODY> 
</HTML>