<?php 
  include '../html/connect_to_mydb.php';
  include '../html/loadproductbarcode.php';
?>

<?php 
  $adminorderlists = mysqli_query($con, 'SELECT * FROM mydb.order');
  $costomer_address = mysqli_query($con, 'SELECT * FROM mydb.costomer');

  $address_orderlist = 
  mysqli_query($con,
    "SELECT * 
      FROM mydb.order O 
        INNER JOIN mydb.costomer C 
          ON O.costomer_id = C.costomer_id
        INNER JOIN mydb.product P
          ON O.order_barcode = P.product_barcode
      ORDER BY O.order_no") or die(mysqli_error($con));

  echo '<TABLE BORDER=1>';
  echo '<TH>주문 번호</TH>';
  echo '<TH>아이디</TH>';
  echo '<TH>고객 번호</TH>';
  echo '<TH>이름</TH>';
  echo '<TH>주소</TH>';
  echo '<TH>제품 사진</TH>';
  echo '<TH>제품 이름</TH>';
  echo '<TH>바코드번호</TH>';
  echo '<TH>사이즈</TH>';
  echo '<TH>수량</TH>';
  echo '<TH>위치</TH>';

  $order_num = 0;
  $numoforder = array();
  $row = mysqli_fetch_array($address_orderlist);
  $order_no = $row['order_no'];
  $numoforders[$order_no] = 1;

  while($row = mysqli_fetch_array($address_orderlist)){
    echo "<TR>";
    $order_no = $row['order_no'];
    if ($order_no == $row['order_no']){
      $numoforders[$order_no] = $numoforders[$order_no] + 1;;
    }
    else {
      $numoforders[$order_no] = 1;
    }
  }

  $address_orderlist = 
    mysqli_query($con,"SELECT * FROM mydb.order O INNER JOIN mydb.costomer C 
            ON O.costomer_id = C.costomer_id INNER JOIN mydb.product P
            ON O.order_barcode = P.product_barcode ORDER BY O.order_no") 
            or die(mysqli_error($con));

  $key_arrays = array_keys($numoforders); // 주문번호, 키값
  $values_arrays = array_values($numoforders); // 주문개수, value값
  $num_key_arrays = 0; // 주문번호 외부 저장
  $num_value_arrays = 0; // 주문개수 외부 저장
  $index_num = 0; // 인덱스값
  $num_key_arrays = $key_arrays[0];
  $num_value_arrays = $values_arrays[0];
  $i=0;

  while($row = mysqli_fetch_array($address_orderlist)){  
    $order_no = $row['order_no'];

    if ($key_arrays[$index_num] == $order_no){ // 주문번호가 while문의 주문번호와 같은 경우
      if($values_arrays[$index_num] != $num_value_arrays){
        $row['order_no'] = NULL;
        $row['costomer_id'] = NULL;
        $row['costomer_no'] = NULL;
        $row['costomer_name'] = NULL;
        $row['costomer_home'] = NULL;
      }

      $num_value_arrays = $num_value_arrays - 1;
      echo "<TD rowspan = ",$numoforder,">", $row['order_no'], "</TD>";
      echo "<TD rowspan = ",$numoforder,">", $row['costomer_id'], "</TD>";
      echo "<TD rowspan = ",$numoforder,">", $row['costomer_no'], "</TD>";
      echo "<TD rowspan = ",$numoforder,">", $row['costomer_name'], "</TD>";
      echo "<TD rowspan = ",$numoforder,">", $row['costomer_home'], "</TD>";
    }

    else{ // while주문번호와 배열주문번호가 다른경우
      if($num_value_arrays == 0){
        $index_num = $index_num + 1;
        $num_key_arrays = $key_arrays[$index_num];
        $num_value_arrays = $values_arrays[$index_num];
      }

      $num_value_arrays = $num_value_arrays - 1;
      echo "<TD rowspan = ",$numoforder,">", $row['order_no'], "</TD>";
      echo "<TD rowspan = ",$numoforder,">", $row['costomer_id'], "</TD>";
      echo "<TD rowspan = ",$numoforder,">", $row['costomer_no'], "</TD>";
      echo "<TD rowspan = ",$numoforder,">", $row['costomer_name'], "</TD>";
      echo "<TD rowspan = ",$numoforder,">", $row['costomer_home'], "</TD>";
      
    }
    
    echo "<TD> <img src = '",$row['product_image_path'], 
         "' width = '200px' height = '200px'></TD>";
    echo "<TD>", $row['product_name'], "</TD>";
    echo "<TD>", $row['product_barcode'], "</TD>";
    echo "<TD>", $row['product_size'], "</TD>";
    echo "<TD>", $row['number_of_order'], "</TD>";
    echo "<TD>", $row['product_location'], "</TD>";

    echo "</TR>";
  }

  echo "</TABLE>";

