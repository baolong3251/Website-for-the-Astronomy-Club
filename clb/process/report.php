<?php

	require '../connect.php';
	$post_id = $_POST['report_id'];

	$update = "UPDATE post SET post_stat = post_stat - 1 where post_id = '$post_id'";
	$run = mysqli_query($conn,$update);