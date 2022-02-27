<?php
	require '../connect.php';
	$select = "SELECT * FROM users";
	$run = mysqli_query($conn,$select);
	
	while ($row = mysqli_fetch_array($run)) {
		$user_id = $row['user_id'];
		$count = 0;

		$post = "SELECT * FROM post where user_id = '$user_id'";
		$run_p = mysqli_query($conn,$post);
		$count = mysqli_num_rows($run_p);

		$update = "UPDATE users SET num_post = '$count' where user_id = '$user_id'";
		$run_u = mysqli_query($conn,$update);
		
	}