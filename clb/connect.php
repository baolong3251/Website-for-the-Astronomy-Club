<?php

$servername = "localhost";
$dBUsername = "root";
$dBPassword = "";
$dBName = "csdl_clb";

$conn = mysqli_connect($servername, $dBUsername, $dBPassword, $dBName);
mysqli_set_charset($conn,'UTF8');
if (!$conn) {
	die('connection failed: ' . mysqli_connect_error());
}
