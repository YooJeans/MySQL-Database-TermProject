<?php 
  include 'connect_to_mydb.php';
  include 'inc_head.php';
?>

<HTML>
 <link href="..\images\logo\small_logo.ico" rel="shortcut icon" type="image/x-icon">
 <title>ORDER LIST</title>
 <META http-equiv="content-type" content="text/html; charset=utf-8"> 
 <link href="\termproject\css\styles.css" rel="stylesheet" />
      <style type="text/css"> 
      a { text-decoration:none } 
      /* link - 아직 클릭하지 않은 경우  */
      a:link { color: black;} 
      /* visited - 한번 클릭하거나 전에 클릭한적 있을 경우  */
      a:visited { color: black;}  
      /* hover - 마우스를 해당 링크에 위치했을 경우  */
      a:hover { color: green;}
      table {  width:70%; margin-left:15%; margin-right:15%; text-align: center; }
      table, td, th { border-collapse : collapse; border : 1.5px solid black;}
      td img {width: 150px; height: 150px;};
     </style>
</HTML>

<?php 
    $costomer_id = $_SESSION['costomer_id'];
    $sql = mysqli_query($con, "
            SELECT * FROM mydb.order O 
                INNER JOIN mydb.costomer C 
                    ON O.costomer_id = C.costomer_id
                INNER JOIN mydb.product P
                    ON O.order_barcode = P.product_barcode
            ORDER BY O.order_no") or die (mysqli_error($con));

    if($sql) { 
    $count = mysqli_num_rows($sql);
    } 
    else { 
       echo "데이터 검색 실패!!!"."<br>";
       echo "실패 원인 :".mysqli_error($con);
       exit();
    }  
 
    echo "<H1>주문서</H1>";
    echo "<TABLE BORDER=1>";
    echo "<TR>";
    echo "<TH>주문 번호</TH> <TH>상품 사진</TH> <TH>바코드 번호</TH> <TH>사이즈</TH> <TH>수량</TH> <TH>가격</TH> <TH>삭제</TH>";
    echo "</TR>";
    while($row = mysqli_fetch_array($sql)) {
        if ($costomer_id == $row['costomer_id']) {       
            echo "<TR>";
            echo "<TD>", $row['order_no'], "</TD>";
            echo "<TD>", "<img src=".$row['product_image_path'].">", "</TD>";
            echo "<TD>", $row['order_barcode'], "</TD>";
            echo "<TD>", $row['product_size'], "</TD>";             
            echo "<TD>", $row['number_of_order'], "</TD>";
            echo "<TD>", $row['order_price'], "</TD>";
            echo "<TD>", "<A HREF='orderdelete.php?order_barcode=", $row['order_barcode'], "'>삭제</A></TD>";     
            // print_r($order_barcode);
            // echo '<br>';
            echo "</TR>";
        }

    }; 
 
    mysqli_close($con);
    echo "</TABLE>";
    echo "<BR> <A HREF='home.php'> 홈 화면</A> ";
?>