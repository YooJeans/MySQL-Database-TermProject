<?php
	// $con = mysqli_connect("172.20.10.9", "cookUser", "1234", "mydb") or die(mysqli_error($con));
	// $con = mysqli_connect("192.168.31.75", "cookUser", "1234", "mydb") or die(mysqli_error($con));
	// $con = mysqli_connect("192.168.0.10", "cookUser", "1234", "mydb") or die(mysqli_error($con));
	$con = mysqli_connect("localhost", "cookUser", "1234", "mydb") or die(mysqli_error($con));

  	mysqli_select_db($con, 'mydb') or die(mysqli_error($con));
?>h