<?php
  session_start();
  $_SESSION['emp_no'];
  $_SESSION['emp_name'];
  if( isset( $_SESSION['emp_name'] ) ) {
    $login_state = TRUE;
  }
  else
    $login_state = FALSE;
?>
