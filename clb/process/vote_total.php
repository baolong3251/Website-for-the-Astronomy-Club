<?php
session_start();
$conn = new mysqli('localhost', 'root', '', 'csdl_clb');
mysqli_set_charset($conn,'UTF8');
include ('../functions.php');
	// update_user_point();
	update_user_rank();
	
	if (isset($_SESSION['userid'])) {
		$vote_user_id = $_SESSION['userid'];
		}	

	$post_id = $_POST['post_id'];

	
	$get_post_vote = "SELECT * FROM post where post_id='$post_id'";
	$run_post_vote = mysqli_query($conn,$get_post_vote);
	$row_post_vote = mysqli_fetch_array($run_post_vote);
	$post_vote_like = $row_post_vote['post_like'];
	$post_vote_dislike = $row_post_vote['post_dislike'];
	$post_view_up = $row_post_vote['post_view'];
	

	if (isset($_SESSION['userid'])) {
	$insert_vote = "INSERT INTO vote_status (user_id, post_id)
	SELECT * FROM (SELECT '$vote_user_id', '$post_id') AS tmp
	WHERE NOT EXISTS (
	    SELECT vote_value FROM vote_status WHERE user_id = '$vote_user_id' AND post_id= '$post_id'
	) LIMIT 1";
		$run_vote = mysqli_query($conn,$insert_vote);

	$get_vote = "SELECT * FROM vote_status where post_id='$post_id' AND user_id='$vote_user_id'";
	$run_vote2 = mysqli_query($conn,$get_vote);
	$row_vote = mysqli_fetch_array($run_vote2);
	$vote_value = $row_vote['vote_value']; 

	$output = '';

	if ($vote_value==1) {
 $output .= '
 <i class="far fa-eye" style="color: lightgreen;"></i>  
 	'.$post_view_up.'
 	<a onclick="like_update();" href="javascript:void(0)">
				<i class="fas fa-heart like" id="like" style="color: red;"></i></a> '.$post_vote_like.' 
	<a onclick="dislike_update();" href="javascript:void(0)">			
				<i class="fas fa-heart-broken dislike" id="dislike" style="color: grey;"></i></a> '.$post_vote_dislike.'
 ';}
 else if ($vote_value==-1) {
 	$output .= '
 <i class="far fa-eye" style="color: lightgreen;"></i>  
 	'.$post_view_up.'
 	<a onclick="like_update();" href="javascript:void(0)">
				<i class="fas fa-heart like" id="like" style="color: grey;"></i></a> '.$post_vote_like.' 
	<a onclick="dislike_update();" href="javascript:void(0)">			
				<i class="fas fa-heart-broken dislike" id="dislike" style="color: purple;"></i></a> '.$post_vote_dislike.'
 ';
 }
 else{
 	$output .= '
 <i class="far fa-eye" style="color: lightgreen;"></i>
 	'.$post_view_up.'
 	<a onclick="like_update();" href="javascript:void(0)">
				<i class="fas fa-heart like" id="like" style="color: grey;"></i></a> '.$post_vote_like.' 
	<a onclick="dislike_update();" href="javascript:void(0)">			
				<i class="fas fa-heart-broken dislike" id="dislike" style="color: grey;"></i></a> '.$post_vote_dislike.'
 ';
 		}
	}

else{

	$get_vote = "SELECT * FROM vote_status where post_id='$post_id'";
	$run_vote2 = mysqli_query($conn,$get_vote);
	$row_vote = mysqli_fetch_array($run_vote2);
	$vote_value = $row_vote['vote_value'];
	
	$output='';
	
 	$output .= '
 <i class="far fa-eye" style="color: lightgreen;"></i>  
 	'.$post_view_up.'
 	<a onclick="pop_up_fail();" href="javascript:void(0)">
				<i class="fas fa-heart" style="color: grey;"></i></a> '.$post_vote_like.' 
	<a onclick="pop_up_fail();" href="javascript:void(0)">			
				<i class="fas fa-heart-broken" style="color: grey;"></i></a> '.$post_vote_dislike.'
 ';
 
	}


echo $output;




?>

