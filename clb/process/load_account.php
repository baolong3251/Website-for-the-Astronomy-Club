<?php
	
	session_start();
	$conn = new mysqli('localhost', 'root', '', 'csdl_clb');

	

  $user_id = $_POST['user_id'];
  mysqli_set_charset($conn,'UTF8');
  $get_data = "SELECT * FROM users WHERE user_id='$user_id'";
  $run_data = mysqli_query($conn,$get_data);
  $row_data = mysqli_fetch_array($run_data);
  $user_name = $row_data['user_name'];
  $user_point = $row_data['user_point'];
  $user_pic = $row_data['user_pic'];
  $user_rank = $row_data['user_rank'];

  if($user_pic==""){
              echo "<div id='avatar' style='background-image: url(images/icon.png);'></div>"; //style='width: 50px; height: 50px;' mr-2
            }else {
              echo "<div id='avatar' style='background-image: url(images/$user_pic);'></div>";
            }



?>
