<?php
	require '../connect.php';
	session_start();
	if (isset($_SESSION['userid'])) {
		$user_id = $_SESSION['userid'];
	}
	$post_id = $_POST['post_id'];
	mysqli_set_charset($conn,'UTF8');
	$select = "SELECT * FROM vote_status where user_id = '$user_id' AND post_id = '$post_id'";
	$run = mysqli_query($conn,$select);
	$row = mysqli_fetch_array($run);

	$select2 = "SELECT * FROM post where post_id = '$post_id'";
	$run2 = mysqli_query($conn,$select2);
	$row2 = mysqli_fetch_array($run2);
	$post_like = $row2['post_like'];
	$post_dislike = $row2['post_dislike'];

	$vote_value = $row['vote_value'];

	if ($vote_value == 1) {
		echo "	<p><a href='javascript:void(0)' style='color: orange;' class='like' id='$post_id'>Thích: $post_like</a></p>
				<p><a href='javascript:void(0)' class='dislike' id='$post_id'>Không thích: $post_dislike</a></p>";
	}

	if ($vote_value == -1) {
		echo "<p><a href='javascript:void(0)' class='like' id='$post_id'>Thích: $post_like</a></p>
			<p><a href='javascript:void(0)' style='color: blue;' class='dislike' id='$post_id'>Không thích: $post_dislike</a></p>";
	}

	if ($vote_value == 0) {
		echo "<p><a href='javascript:void(0)' class='like' id='$post_id'>Thích: $post_like</a></p>
			<p><a href='javascript:void(0)' class='dislike' id='$post_id'>Không thích: $post_dislike</a></p>";
	}
