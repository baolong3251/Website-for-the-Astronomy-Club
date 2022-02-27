<?php
require '../connect.php';
$user_id = $_POST['user_id'];
mysqli_set_charset($conn,'UTF8');
$select = "SELECT * FROM users where user_id='$user_id'";
$run_select = mysqli_query($conn,$select);
$row_select = mysqli_fetch_array($run_select);
$user_full_name = $row_select['user_full_name'];
$ID = $row_select['user_id'];
if ($user_full_name == '') {
	echo "Chưa có tên đầy đủ";
}else{
echo "
		$user_full_name


";
}