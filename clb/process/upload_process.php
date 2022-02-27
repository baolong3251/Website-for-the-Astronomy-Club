<?php

require 'connect.php';
mysqli_set_charset($conn,'UTF8');
$editorContent = $statusMsg = '';

if (isset($_POST['submit'])) {
	$editorContent = $_POST['content'];
	$post_name = $_POST['post_title'];
	
	$post_user_id = $_POST['post_user_id'];
	$post_tag = $_POST['post_tag'];

	if (!empty($post_name)) {
	

	if (!empty($editorContent)) {
		$insert = $conn->query("INSERT INTO post (post_content, post_name, post_type, user_id, post_stat) VALUES ('".$editorContent."','$post_name','$post_tag','$post_user_id','1')");
		
		$insert2 = $conn->query("UPDATE users SET num_post=num_post+1 where user_id='$post_user_id'");
		
	
	if ($insert) {
			$statusMsg = "<p style='color: #e4e6eb;'>Thành công</p>";

	}else{
			$statusMsg = "<p style='color: #e4e6eb;'>Some Problem occured, please try again</p>";
		}
	}else{
		$statusMsg = "<p style='color: #e4e6eb;'>Nội dung không được để trống</p>";
	}

	}else{
		$statusMsg = "<p style='color: #e4e6eb;'>Tựa không được để trống</p>";
	}
}

if (isset($_POST['submit-event'])) {
	$editorContent = $_POST['content'];
	$post_name = $_POST['post_title'];
	$post_user_id = $_POST['post_user_id'];
	$exp_date = $_POST['exp_date'];

	if (!empty($post_name)) {
	
	if (!empty($exp_date)) {

	if (!empty($editorContent)) {
		$insert = $conn->query("INSERT INTO post (post_content, post_name, post_type, user_id, post_exp_date) VALUES ('".$editorContent."','$post_name','3','$post_user_id','$exp_date')");
	
	if ($insert) {
			$statusMsg = "<p style='color: #e4e6eb;'>Thành công</p>";

	}else{
			$statusMsg = "<p style='color: #e4e6eb;'>Some Problem occured, please try again</p>";
		}
	}else{
		$statusMsg = "<p style='color: #e4e6eb;'>Nội dung không được để trống</p>";
		}
	}else{
		$statusMsg = "<p style='color: #e4e6eb;'>Ngày kết thúc không được để trống</p>";
	}

	}else{
		$statusMsg = "<p style='color: #e4e6eb;'>Tựa không được để trống</p>";
	}
}