<?php 
  include 'connect_to_mydb.php';
?>

<?php 

     $sql = "SELECT * FROM costomer WHERE costomer_id='".$_POST['costomer_id']."'";
 
     $ret = mysqli_query($con, $sql);
     if($ret) { 
       $count = mysqli_num_rows($ret);
       if($count==0) { 
         echo $_POST['costomer_id']." 아이디의 회원이 없음!!!"."<BR>";
         echo "<BR> <A HREF='sign.html'> 초기 화면</A> ";
         exit();
       } 
    } 
    else { 
         echo "데이터 검색 실패!!!"."<BR>";
         echo "실패 원인 :".mysqli_error($con);
         echo "<BR> <A HREF='sign.html'> 초기 화면</A> ";
         exit();
    } 
    $row = mysqli_fetch_array($ret);
    $costomer_no = $row["costomer_no"];
    $costomer_id = $row['costomer_id'];
    $costomer_name = $row["costomer_name"];
    $costomer_grade = $row["costomer_grade"];
    $costomer_telephone = $row["costomer_telephone"];
    $costomer_home = $row["costomer_home"];

?> 

 <HTML> 
 <HEAD> 
 <title>UPDATE</title>
 <META http-equiv="content-type" content="text/html; charset=utf-8"> 
 <link href="/termproject/css/styles.css" rel="stylesheet" />
 </HEAD> 
 <BODY> 

 <H1>회원 정보 수정</H1> 
    <div style="text-align: center;">
 <FORM METHOD="post" ACTION="update_result.php">
     회원 번호 : <INPUT TYPE="text" NAME="costomer_no" VALUE=<?php echo $costomer_no ?> READONLY> <BR>
     아이디 : <INPUT TYPE="text" NAME="costomer_id" VALUE=<?php echo $costomer_id ?>> <BR> 
     이름 : <INPUT TYPE="text" NAME="costomer_name" VALUE=<?php echo $costomer_name ?>> <BR> 
     등급 : <INPUT TYPE="text" NAME="costomer_grade" VALUE=<?php echo $costomer_grade ?> READONLY> <BR>
     전화번호 : <INPUT TYPE="text" NAME="costomer_telephone" VALUE=<?php echo $costomer_telephone ?>> <BR> 
     주소 : <INPUT TYPE="text" NAME="costomer_home" VALUE=<?php echo $costomer_home ?>> <BR> 
     <BR><BR> 
     <INPUT TYPE="submit" VALUE="정보 수정"> 
 </FORM> 
 </BODY> 
 </HTML>
