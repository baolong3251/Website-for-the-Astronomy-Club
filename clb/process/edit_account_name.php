<?php

	require '../connect.php';
	$user_id = $_POST['user_id_account_2'];
	$user_name = $_POST['edit_name_value'];

	if (!empty($user_name)) {

		$select = "SELECT * FROM users where user_name='$user_name'";
		$run_select = mysqli_query($conn,$select);
		if(!$row_select = mysqli_fetch_array($run_select)){

		$update = "UPDATE users SET user_name = '$user_name' WHERE user_id = '$user_id'";
		$run_update = mysqli_query($conn,$update);
		
		}
	}