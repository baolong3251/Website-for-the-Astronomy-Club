<?php
$servername = "localhost";
$dBUsername = "root";
$dBPassword = "";
$dBName = "csdl_clb";

$conn = mysqli_connect($servername, $dBUsername, $dBPassword, $dBName);
mysqli_set_charset($conn,'UTF8');
$comment_id = $_POST['comment_id'];
$comment_content = $_POST['comment_content'];

if (!empty($comment_content)) {

$sql_del = "UPDATE comment SET comment_value='$comment_content' WHERE comment_id='$comment_id'";
$run_query = mysqli_query($conn,$sql_del);
}

?>