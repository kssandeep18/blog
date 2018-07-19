<?php
	$con=mysqli_connect("localhost","root","");
	if(!$con){
		echo "Server error".mysqli_error($con);
	}
	$db=mysqli_select_db($con,"blog");
	if(!$db){
		echo "DB error".mysqli_error($con);
	}
?>