<HTML>
 <link href="..\images\logo\small_logo.ico" rel="shortcut icon" type="image/x-icon">
 <title>ORDER DELETE RESULT</title>
 <META http-equiv="content-type" content="text/html; charset=utf-8"> 
 <link href="/termproject/css/styles.css" rel="stylesheet" />
      <style type="text/css"> 
      a { text-decoration:none } 
      /* link - 아직 클릭하지 않은 경우  */
      a:link { color: black;} 
      /* visited - 한번 클릭하거나 전에 클릭한적 있을 경우  */
      a:visited { color: black;}  
      /* hover - 마우스를 해당 링크에 위치했을 경우  */
      a:hover { color: green;}
      table {  width:70%; margin-left:15%; margin-right:15%; text-align: center; }
      table, td, th { border-collapse : collapse; border : 1.5px solid black;};
     </style>
</HTML>

<?php 
     $con = mysqli_connect("172.20.10.9", "cookUser", "1234", "mydb") or die("MySQL 접속 실패!!");
 
     $order_barcode = $_POST["order_barcode"];
 
     $sql = "DELETE FROM mydb.order WHERE order_barcode='".$order_barcode."'";
 
     $ret = mysqli_query($con, $sql);
 
    echo "<H1>상품 삭제 결과</H1>";
    if($ret) { 
    echo $order_barcode." 상품이 성공적으로 삭제됨..";
    } 
    else { 
       echo "데이터 삭제 실패!!!"."<BR>";
       echo "실패 원인 :".mysqli_error($con);
    } 
    mysqli_close($con);
 
    echo "<BR><BR> <A HREF='myorderpage.php'> 주문서 화면</A> ";
 ?>
