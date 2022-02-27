<?php

//add_comment.php
		$conn = new PDO('mysql:host=localhost;mysql:charset=utf8;dbname=csdl_clb', 'root', '');
		

		$error = '';
		$user = '';
		$password = '';
		$re_password = '';



		if(empty($_POST["user"]) || empty($_POST["password"]) || empty($_POST["re_password"]))
		{
		 $error .= '<p style="color: red; padding: none;">Không được để trống bất kì thông tin nào</p>';
		}
		else
		{
		 $user = $_POST["user"];
		 $password = $_POST["password"];
		 $re_password = $_POST["re_password"];
		}

		if($password!==$re_password)
		{
		 $error .= '<p style="color: red;">Mật khẩu không khớp!!</p>';
		}

		if (!preg_match("/^[a-zA-Z0-9]*$/", $user)) {
			$error .= '<p style="color: red;">Tài khoản không hợp lệ</p>';	
		}

		

		if($error == '')
		{
			$sthandler = $conn->prepare("SELECT user_name FROM users WHERE user_name = :name");
			$sthandler->bindParam(':name', $user);
			$sthandler->execute();
			if($sthandler->rowCount() > 0){
		    $error .= '<p style="color: red;">Tài khoản đã được đăng ký xin nhập tài khoản khác!!</p>';
			} else {


			$hashedPwd = password_hash($password, PASSWORD_DEFAULT);
			$pic = 'icon.png';

		 $query = "
		 INSERT INTO users 
		 (user_name, password, user_pic) 
		 VALUES (:user, :password, :pic)
		 ";
		 $statement = $conn->prepare($query);
		 $statement->execute(
		  array(
		   ':user' => $user,
		   ':password' => $hashedPwd,
		   ':pic' => $pic

		  )
		 );
		 }
		}
		// mysqli_stmt_close($stmt);
		// mysqli_close($conn);

		$data = array(
		 'error'  => $error
		);

		echo json_encode($data);
?>

