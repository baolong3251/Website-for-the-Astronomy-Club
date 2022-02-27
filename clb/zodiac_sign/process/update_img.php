<?php

	$conn=mysqli_connect('localhost','root','','csdl_clb');
	mysqli_set_charset($conn,'UTF8');
		$star_id = $_POST['img_id'];

		$star_img = $_FILES['img_name']['name'];

		$pic_type = $_FILES['img_name']['type'];

		$temp_name = $_FILES['img_name']['tmp_name'];

		$file=$star_img;

		move_uploaded_file($temp_name,"../zodiac_sign/".$file);


		// $file = addslashes(file_get_contents($_FILES["image"]["tmp_name"]));
		  $query = "UPDATE zodiac_sign SET star_img = '$file' WHERE star_id = '".$star_id."'";
		  if(mysqli_query($conn, $query))
		  {
		   echo 'Image Updated into Database';
		  }
		
		


?>