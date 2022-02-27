<?php
	require '../connect.php';
	mysqli_set_charset($conn,'UTF8');
	$post_id = $_POST['query'];
	$select_point = "SELECT * FROM point_categories";
	$run_point = mysqli_query($conn,$select_point);
	while ($row = mysqli_fetch_array($run_point)) {
		if ($row['point_name'] == 'View') {
			$point_view = $row['point_value'];
		}
		if ($row['point_name'] == 'Like') {
			$point_like = $row['point_value'];
		}
		if ($row['point_name'] == 'Dislike') {
			$point_dislike = $row['point_value'];
		}
	}
	$select_post = "SELECT * FROM post where post_id = '$post_id'";
	$run_post = mysqli_query($conn,$select_post);
	$row_post = mysqli_fetch_array($run_post);
	$post_user_id = $row_post['user_id'];

	$point = 0;
	$select_post_2 = "SELECT * FROM post where user_id = '$post_user_id' AND post_type != 3";
	$run_post_2 = mysqli_query($conn,$select_post_2);
	while ($row_post_2 = mysqli_fetch_array($run_post_2)) {
		$post_view = $row_post_2['post_view'];
		$post_like = $row_post_2['post_like'];
		$post_dislike = $row_post_2['post_dislike'];

		$point = $point + ($post_view * $point_view) + ($post_like * $point_like) + ($point_dislike * $post_dislike);
	}
	
	$update = "UPDATE users SET user_point = '$point' where user_id = '$post_user_id' AND user_name != 'admin'";
	$run_update = mysqli_query($conn,$update);
