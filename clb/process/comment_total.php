<?php
$conn = new mysqli('localhost', 'root', '', 'csdl_clb');

$post_id = $_POST['product_id'];
$numComments = 0;
	
	$get_post_comment = "SELECT post_id FROM comment where post_id = '$post_id'";
	$run_post_comment = mysqli_query($conn,$get_post_comment);
	$numComments = mysqli_num_rows($run_post_comment);
	$output = '';

 $output .= '
 <div>
 	<h2 style="color: black;"><b id="numComments">'.$numComments.' Bình luận</b></h2>
 </div>
 
 ';


echo $output;