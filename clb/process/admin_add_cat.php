<?php 

	require '../connect.php';
	$cat_name = $_POST['cat_name'];
	mysqli_set_charset($conn,'UTF8');
	$insert = "INSERT INTO post_categories (post_cat_name) VALUES ('$cat_name')";
	$run = mysqli_query($conn,$insert);