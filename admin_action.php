<?php
	include "db.php";
	if(isset($_GET['op']) && $_GET['op']=="delete"){
		$id=$_GET['id'];
		$query="DELETE FROM post WHERE post_id=$id";
		$res=mysqli_query($con,$query);
		if($res){
			echo 1;
		}
		else{
			echo 0;
		}
	}
	else if(!empty($_FILES['file']['name'])){
		$heading=$_POST['heading'];
		$desc=$_POST['desc'];
		$files=$_FILES['file']['name'];
		$target="images/".$_FILES['file']['name'];
		if(move_uploaded_file($_FILES['file']['tmp_name'],$target)){
			$query="INSERT INTO post VALUES ('','$heading','$desc','$files',now())";
			if(mysqli_query($con,$query)){
				echo "1";
			}
			else{
				echo "0";
			}
		}
	}
	else if($_GET['op']=="edit"){
		$id=$_GET['id'];
		$query="SELECT * FROM post WHERE post_id='$id'";
		$res=mysqli_query($con,$query);
		//echo mysqli_error($con);
		$arr=[];
		if($res){
			while($row=mysqli_fetch_row($res)){
				$arr[0]=$row[0];
				$arr[1]=$row[1];
				$arr[2]=$row[2];
				//echo $arr[0].$arr[1].$arr[2];
			}
			echo json_encode($arr);
		}
		else{
			$arr[0]=0;
			echo json_encode();
		}
	}

	else if($_GET['op']=="update"){
		$id=$_GET['edit_id'];
		$edit_heading=mysqli_real_escape_string($con, $_GET['edit_heading']);
		$edit_desc=mysqli_real_escape_string($con, $_GET['edit_desc']);
		$query="UPDATE post SET post_heading='$edit_heading',post_content='$edit_desc' WHERE post_id='$id'";
		$res=mysqli_query($con,$query);
		if($res){
			echo $_GET['edit_heading'];
		}
		else{
			echo 0;
		}
	}


?>