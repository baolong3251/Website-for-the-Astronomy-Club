<?php

	require '../connect.php';

	$post_img_id = $_POST['post_img_id'];
	$count = 0;
	$output = '';

	$select_img = "SELECT * FROM images where img_id = '$post_img_id'";
	$run_img = mysqli_query($conn,$select_img);
	$row = mysqli_fetch_array($run_img);
	$post_id = $row['post_id'];

	$select_img2 = "SELECT * FROM images where post_id = '$post_id'";
	$run_img2 = mysqli_query($conn,$select_img2);
	$count = mysqli_num_rows($run_img2);

	if ($count == 1) {
		
	}else{
	$del = "DELETE FROM images WHERE img_id = '$post_img_id'";
	$run = mysqli_query($conn,$del);
	}
