<?php

	require '../connect.php';
	$user_id = $_POST['user_id_account_3'];
	$user_fullname = $_POST['edit_fullname_value'];

	


		$update = "UPDATE users SET user_full_name = '$user_fullname' WHERE user_id = '$user_id'";
		$run_update = mysqli_query($conn,$update);
		
		
	