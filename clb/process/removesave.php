<?php 

	require '../connect.php';
	$user_id = $_POST['user_id'];
	$post_id = $_POST['p_id2'];
	$del = "DELETE FROM save_post where save_post_id = '$post_id' AND save_user_id = '$user_id'";
	$run = mysqli_query($conn,$del);