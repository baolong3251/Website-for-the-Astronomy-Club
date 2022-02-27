<?php
$servername = "localhost";
$dBUsername = "root";
$dBPassword = "";
$dBName = "csdl_clb";

$conn = mysqli_connect($servername, $dBUsername, $dBPassword, $dBName);

$user_id = $_POST['comment_id_2'];

$sql_del = "DELETE FROM users WHERE user_id='$user_id'";
$run_query = mysqli_query($conn,$sql_del);


?>