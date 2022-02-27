<?php
	$servername = "localhost";
	$dBUsername = "root";
	$dBPassword = "";
	$dBName = "csdl_clb";

	$conn = mysqli_connect($servername, $dBUsername, $dBPassword, $dBName);

	$post_id = $_POST['post_id_delete'];

	$select = "SELECT * FROM post where post_id='$post_id'";
	$run_query = mysqli_query($conn,$select);
	if($row = mysqli_fetch_array($run_query)){
	
	$user_id = $row['user_id'];
	$post_type = $row['post_type'];

	// $sql_del_1 = "DELETE FROM vote_status WHERE post_id='$post_id'";
	// $run_1 = mysqli_query($conn,$sql_del_1);

	// $sql_del_2 = "DELETE FROM save_post WHERE save_post_id='$post_id'";
	// $run_2 = mysqli_query($conn,$sql_del_2);

	$sql_del = "DELETE FROM post WHERE post_id='$post_id'";
	$run = mysqli_query($conn,$sql_del);

	if ($post_type == 2) {
		$sql_del_img = "DELETE FROM images WHERE post_id='$post_id'";
		$run_img = mysqli_query($conn,$sql_del_img);
	}
	

	$count = 0;
	$select2 = "SELECT user_id FROM post where user_id='$user_id'";
	$run_query2 = mysqli_query($conn,$select2);
	$count = mysqli_num_rows($run_query2);

	$update = "UPDATE users SET num_post='$count' where user_id='$user_id'";
	$run_up = mysqli_query($conn,$update);
	}
?>