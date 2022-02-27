<?php

//add_comment.php
		$servername = "localhost";
		$dBUsername = "root";
		$dBPassword = "";
		$dBName = "csdl_clb";

		$conn = mysqli_connect($servername, $dBUsername, $dBPassword, $dBName);
		mysqli_set_charset($conn,'UTF8');
		$error = '';
		$user = '';
		$mat_khau = '';



		if(empty($_POST["user_signin"]) || empty($_POST["password_signin"]))
		{
		 $error .= '<p style="color: red; padding: none;">Không được để trống bất kì thông tin nào</p>';
		}
		else
		{
		 $user = $_POST['user_signin'];
		 $password = $_POST['password_signin'];
		}


		if($error == '')
		{
		 $sql = "
		 SELECT * FROM users where user_name='$user'";
		 $run_sql = mysqli_query($conn,$sql);
		 $row_query = mysqli_fetch_assoc($run_sql);
		 $pwdcheck = $row_query['password'];
		 
		 $pwdcheck2 = password_verify($password, $pwdcheck);
			
		 	if ($pwdcheck2 == false) {
						$error .= '<p style="color: red; padding: none;">Sai mật khẩu!!</p>';
					}
					 if ($pwdcheck2 == true){
						session_start();
						 $_SESSION['userid'] = $row_query['user_id'];
						 $_SESSION['useruid'] = $row_query['user_name'];

						

					}
					

			
		}
	
		$data = array(
		 'error'  => $error
		);

		echo json_encode($data);

?>

