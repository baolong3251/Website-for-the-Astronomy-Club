<?php

	require '../connect.php';
	$cat_id = $_POST['cat_id_delete'];
	$del = "DELETE FROM post_categories where post_type = '$cat_id'";
	$run = mysqli_query($conn,$del);
	$update = "UPDATE post SET post_type = 1 where post_type = '$cat_id'";
	$run2 = mysqli_query($conn,$update);