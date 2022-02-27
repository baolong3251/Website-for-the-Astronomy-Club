<?php
	$servername = "localhost";
	$dBUsername = "root";
	$dBPassword = "";
	$dBName = "csdl_clb";

	date_default_timezone_set('Asia/Ho_Chi_Minh');

	$conn = mysqli_connect($servername, $dBUsername, $dBPassword, $dBName);

	$post_id = $_POST['post_id'];

	$update = "UPDATE post SET post_stat='0', post_date=now() where post_id='$post_id'";
	$run_up = mysqli_query($conn,$update);
	
?>