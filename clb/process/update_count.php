<?php
$conn=mysqli_connect('localhost','root','','csdl_clb');
mysqli_set_charset($conn,'UTF8');
$type=$_POST['type'];
$id=$_POST['id'];
$vote_user_id=$_POST['vote_user_id'];
$post_like_up=0;
$post_like_down=0;

$get_vote_post = "SELECT * FROM post where post_id='$id'";
$run_vote_post = mysqli_query($conn,$get_vote_post);
$row_vote_post = mysqli_fetch_array($run_vote_post);
$post_like = $row_vote_post['post_like'];
$post_like_up = $post_like+1;
$post_like_down = $post_like-1;
$post_id = $row_vote_post['post_id'];


$get_vote = "SELECT * FROM vote_status where post_id='$id' AND user_id='$vote_user_id'";
$run_vote = mysqli_query($conn,$get_vote);
$row_vote = mysqli_fetch_array($run_vote);
$vote_post_id = $row_vote['post_id'];
// $num_row = 0;
// if ($vote_post_id==$id) {
// 	$num_row++;
// }

// if ($num_row==0) {
// 	$insert_vote = "INSERT INTO vote_status (vote_user_id,vote_post_id) VALUES('$vote_user_id','$post_id')";
// 	$run_vote = mysqli_query($conn,$insert_vote);
// }
$vote_value = $row_vote['vote_value'];
	if ($type==1) {
	if ($vote_value==1) {
		 $sql="UPDATE post SET post_like='$post_like_down' WHERE post_id='$id'";
		$sql2="UPDATE vote_status SET vote_value=0 WHERE post_id='$id' AND user_id='$vote_user_id'";
		
		 $res=mysqli_query($conn,$sql);
		$res2=mysqli_query($conn,$sql2);
		

	} else if($vote_value==-1){
		$sql="UPDATE post SET post_like=post_like+1 WHERE post_id='$id'";
		$sql1="UPDATE post SET post_dislike=post_dislike-1 WHERE post_id='$id'";
		$sql2="UPDATE vote_status SET vote_value=1 WHERE post_id='$id' AND user_id='$vote_user_id'";
		 $res=mysqli_query($conn,$sql);
		 $res1=mysqli_query($conn,$sql1);
		 $res2=mysqli_query($conn,$sql2);
		
	} 
	else{
	 $sql3 = "UPDATE post SET post_like='$post_like_up' WHERE post_id='$id'";
	 $sql2="UPDATE vote_status SET vote_value=1 WHERE post_id='$id' AND user_id='$vote_user_id'";
	 $res3 = mysqli_query($conn,$sql3);
	$res2=mysqli_query($conn,$sql2);

}
}

else{
	if ($vote_value==-1) {
		$sql="UPDATE post set post_dislike=post_dislike-1 where post_id='$id'";
		$sql2="UPDATE vote_status set vote_value=0 where post_id='$id' AND user_id='$vote_user_id'";
		$res=mysqli_query($conn,$sql);
		$res2=mysqli_query($conn,$sql2);
	}else if ($vote_value==1) {
		$sql="UPDATE post set post_dislike=post_dislike+1 where post_id='$id'";
		$sql1="UPDATE post set post_like=post_like-1 where post_id='$id'";
		$sql2="UPDATE vote_status set vote_value=-1 where post_id='$id' AND user_id='$vote_user_id'";
		$res=mysqli_query($conn,$sql);
		$res1=mysqli_query($conn,$sql1);
		$res2=mysqli_query($conn,$sql2);
	}
	else{
	$sql="UPDATE post set post_dislike=post_dislike+1 where post_id='$id'";
	$sql2="UPDATE vote_status set vote_value=-1 where post_id='$id' AND user_id='$vote_user_id'";
	$res=mysqli_query($conn,$sql);
	$res2=mysqli_query($conn,$sql2);
	}
}

?>