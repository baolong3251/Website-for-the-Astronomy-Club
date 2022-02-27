<?php 

	require '../connect.php';
	$event_id_delete = $_POST['event_id_delete'];
	$del = "DELETE FROM post where post_id = '$event_id_delete'";
	$run = mysqli_query($conn,$del); 