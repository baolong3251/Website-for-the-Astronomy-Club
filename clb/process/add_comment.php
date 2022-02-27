		<?php

		//add_comment.php
		$conn = new PDO('mysql:host=localhost;mysql:charset=utf8;dbname=csdl_clb', 'root', '');

		$error = '';
		$comment_name = '';
		$comment_content = '';

		if(empty($_POST["comment_name"]))
		{
		 $error .= '<p style="color: red;">Xin đăng nhập để comment</p>';
		}
		else
		{
		 $comment_name = $_POST["comment_name"];
		}

		if(empty($_POST["comment_content"]))
		{
		 $error .= '<p style="color: red;">Xin mời nhập bình luận</p>';
		}
		else
		{
		 $comment_content = $_POST["comment_content"];
		}

		if($error == '')
		{
		 $query = "
		 INSERT INTO comment 
		 (comment_parent, user_id, post_id, comment_value) 
		 VALUES (:parent_comment_id, :comment_user_id, :comment_product_id, :comment)
		 ";
		 $statement = $conn->prepare($query);
		 $statement->execute(
		  array(
		   ':parent_comment_id' => $_POST["comment_id"],
		   ':comment_user_id' => $_POST["comment_user_id"],
		   ':comment_product_id' => $_POST["comment_product_id"],
		   ':comment' => $comment_content

		  )
		 );
		  $error = '<label style="color: green;">Comment Added</label>';
		}

		$data = array(
		 'error'  => $error
		);

		echo json_encode($data);

		?>