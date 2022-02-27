<?php
$servername = "localhost";
$dBUsername = "root";
$dBPassword = "";
$dBName = "csdl_clb";

$conn = mysqli_connect($servername, $dBUsername, $dBPassword, $dBName);

$comment_id = $_POST['comment_id_2'];

$sql_del = "DELETE FROM comment WHERE comment_id='$comment_id'";
$run_query = mysqli_query($conn,$sql_del);

$sql_del2 = "DELETE FROM comment WHERE comment_parent='$comment_id'";
$run_query2 = mysqli_query($conn,$sql_del2);


?>