<?php

session_start();
if(isset($_SESSION['isLogin'])){
	unset($_SESSION['isLogin']);
	unset($_SESSION['username']);
	unset($_SESSION['user_id']);
	session_destroy();
	header("location:index.php");
}

?>