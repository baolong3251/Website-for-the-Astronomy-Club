<?php

	require '../connect.php';
	$post_id = $_POST['post_id'];
	$user_id = $_POST['user_id'];
	$stat = $_POST['stat'];

	if ($stat == 1) {

		$insert = "INSERT INTO save_post (save_post_id,save_user_id) VALUES ('$post_id','$user_id')";
		$run = mysqli_query($conn,$insert);
	}

	if ($stat == 0) {
		$del = "DELETE FROM save_post WHERE save_post_id = '$post_id' AND save_user_id = '$user_id'";
		$run = mysqli_query($conn,$del);
	}