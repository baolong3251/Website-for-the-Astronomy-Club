<?php

	require '../connect.php';
	$user_id = $_POST['user_id2'];
	mysqli_set_charset($conn,'UTF8');
	$select = "SELECT * FROM post where user_id = '$user_id'";
	$run = mysqli_query($conn,$select);
	while ($row = mysqli_fetch_array($run)) {
		$post_id = $row['post_id'];
		$post_name = $row['post_name'];
		echo "
			<li class='each-post'><a href='posts.php?post=$post_id'>$post_name</a></li>

		";
	}