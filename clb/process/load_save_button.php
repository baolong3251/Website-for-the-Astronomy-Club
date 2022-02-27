<?php

	require '../connect.php';
	$post_id = $_POST['post_id'];
	$user_id = $_POST['user_id'];
	$select = "SELECT * FROM save_post WHERE save_post_id = '$post_id' AND save_user_id = '$user_id'";
	$run = mysqli_query($conn,$select);
	$count = mysqli_num_rows($run);
	if ($count > 0) {
		echo "

			<a href='javascript:void(0)' class='dissave-post'>Hủy lưu</a>


		";
	}
	else{
		echo "

			<a href='javascript:void(0)' class='save-post'>Lưu bài viết</a>


		";
	}