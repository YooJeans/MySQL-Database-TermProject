<?php 
  include 'connect_to_mydb.php';
?>

<HTML>
 <link href="..\images\logo\small_logo.ico" rel="shortcut icon" type="image/x-icon">
 <title>PRODUCT LIST</title>
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
     $sql = "SELECT * FROM product";
 
     $ret = mysqli_query($con, $sql);
     if($ret) { 
     $count = mysqli_num_rows($ret);
     } 
    else { 
       echo "userTBL 데이터 검색 실패!!!"."<br>";
       echo "실패 원인 :".mysqli_error($con);
       exit();
 } 
 
    echo "<H1>재고 검색 결과</H1>";
    echo "<TABLE BORDER=1>";
    echo "<TR>";
    echo "<TH>재고 번호</TH> <TH>가격</TH> <TH>수량</TH> <TH>재고 위치</TH> <TH>재고 이름</TH> <TH>이미지 경로</TH> <TH>수정</TH> <TH>삭제</TH>";
    echo "</TR>";
    while($row = mysqli_fetch_array($ret)) {
       echo "<TR>";
       echo "<TD>", $row['product_barcode'], "</TD>";
       echo "<TD>", $row['price'], "</TD>";
       echo "<TD>", $row['number_of_product'], "</TD>";
       echo "<TD>", $row['product_location'], "</TD>";
       echo "<TD>", $row['product_name'], "</TD>";
       echo "<TD>", $row['product_image_path'], "</TD>";
       echo "<TD>", "<A HREF='product_update.php?product_barcode=", $row['product_barcode'], "'>수정</A></TD>";
       echo "<TD>", "<A HREF='product_delete.php?product_barcode=", $row['product_barcode'], "'>삭제</A></TD>";
       echo "</TR>";
    } 
 
    mysqli_close($con);
    echo "</TABLE>";
    echo "<BR> <A HREF='admin2.html'> 이전 화면</A> ";
?>

