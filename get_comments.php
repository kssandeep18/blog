<?php
include "db.php";

if(isset($_POST['comment']) && isset($_POST['rating'])){
	$post_id=$_POST['post_id'];
	$user_id=$_POST['uid'];
	$comment=$_POST['comment'];
	$rating=$_POST['rating'];
	$query=" INSERT INTO comments VALUES ('','$post_id', '$user_id', '$comment', '$rating', now()) ";
	$result=mysqli_query($con,$query);
	if($result){
		echo "1";
	}
	else{
		echo "0";
	}
}
else if(isset($_GET['id'])){
	$post_id=$_GET['id'];
	$query="SELECT c.cmnt_id,c.comment,c.rating,c.timestamp,u.username FROM comments c,users u, post p WHERE c.post_id='$post_id' AND c.user_id=u.user_id AND c.post_id =p.post_id ORDER BY c.cmnt_id DESC";
	$result=mysqli_query($con,$query);
	$select=mysqli_num_rows($result);
	$data=array();
	if($select>0){
		while($row=mysqli_fetch_assoc($result)){
			$data[]=$row;
		}
	   echo json_encode($data);
	}
	else{
		echo "0";	
	}
}

?>