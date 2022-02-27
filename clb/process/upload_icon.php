<?php

	$conn=mysqli_connect('localhost','root','','csdl_clb');
	mysqli_set_charset($conn,'UTF8');
		$user_id = $_POST['user_id_account'];

		$user_pic = $_FILES['image']['name'];

		$pic_type = $_FILES['image']['type'];

		$temp_name = $_FILES['image']['tmp_name'];

		$file=$user_pic;

		move_uploaded_file($temp_name,"../images/".$file);


		// $file = addslashes(file_get_contents($_FILES["image"]["tmp_name"]));
		  $query = "UPDATE users SET user_pic = '$file' WHERE user_id = '".$user_id."'";
		  if(mysqli_query($conn, $query))
		  {
		   echo 'Image Updated into Database';
		  }
		
		


?>