<?php
$servername = "localhost";
$dBUsername = "root";
$dBPassword = "";
$dBName = "csdl_clb";

$conn = mysqli_connect($servername, $dBUsername, $dBPassword, $dBName);

$post_id = $_POST['post_id_2'];

$sql_del = "DELETE FROM post WHERE post_id='$post_id'";
$run_query = mysqli_query($conn,$sql_del);


?>