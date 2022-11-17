<?php
  ini_set('display_errors', '0')
?>


<?php
  session_start();
  $_SESSION['costomer_id'];
  $_SESSION['costomer_name'];
  if( isset( $_SESSION['costomer_name'] ) ) {
    $login_state = TRUE;
  }
  else
    $login_state = FALSE;
?>
