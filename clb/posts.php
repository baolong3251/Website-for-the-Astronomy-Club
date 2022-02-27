<?php
session_start();
include ('functions.php');
// update_user_point();
update_user_rank();
update_comment_point();

$conn = new mysqli('localhost', 'root', '', 'csdl_clb');
mysqli_set_charset($conn,'UTF8');
$post_id = $_GET['post'];
$numComments = 0;
	
	$get_post_comment = "SELECT post_id FROM comment where post_id = '$post_id'";
	$run_post_comment = mysqli_query($conn,$get_post_comment);
	$numComments = mysqli_num_rows($run_post_comment);
	

	if (isset($_GET['post'])) {
		$get_post =	"SELECT * FROM post WHERE post_id='$post_id'";
		$run_post = mysqli_query($conn,$get_post);
		$row_post = mysqli_fetch_array($run_post);
		$post_user_id = $row_post['user_id'];
		$post_name = $row_post['post_name'];
		$post_content = $row_post['post_content'];
		$post_like = $row_post['post_like'];
		$post_dislike = $row_post['post_dislike'];
		$post_view = $row_post['post_view'];
		$post_type = $row_post['post_type'];
		$post_date2 = $row_post['post_date'];

		$get_user = "SELECT * FROM users where user_id = '$post_user_id'";
		$run_user = mysqli_query($conn,$get_user);
		$row_user = mysqli_fetch_array($run_user);
		$user_name = $row_user['user_name'];
		$user_pic = $row_user['user_pic'];

		

		$get_point_cat = "SELECT * FROM point_categories where point_cat_id = 1";
		$run_point_cat = mysqli_query($conn, $get_point_cat);
		$row_point_cat = mysqli_fetch_array($run_point_cat);
		$point_view = $row_point_cat['point_value'];
		
		$sql = "UPDATE post SET post_view='$post_view'+1 where post_id='$post_id' and post_stat != '1'";
		if ($post_type != 3) {
		// $sql2 = "UPDATE post SET post_point=post_point+'$point_view' where post_id='$post_id'";
		// $res2 = mysqli_query($conn,$sql2);
		}
		
		$res = mysqli_query($conn,$sql);
		
		
		$post_view_up = $row_post['post_view'];
		
	}
 ?>


<!----------------------------------------------------HTML CONTENT------------------------------------------------>

<!DOCTYPE html>
<html>
<head>
	<title></title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.11.2/css/all.css">

	<link rel="stylesheet" href="css/style-main.css">
	
	<link rel="stylesheet" href="jarallax.css">
	
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css">
	
	<link href="https://fonts.googleapis.com/css2?family=Merienda&display=swap" rel="stylesheet">
	
	<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;700&display=swap" rel="stylesheet">
	
	<link href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.2/animate.min.css" rel="stylesheet">
	
	<!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous"> -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>

  	<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

  	<script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.js"></script>

  	<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.css">

	<script defer src="https://use.fontawesome.com/releases/v5.11.1/js/all.js">

	</script>
	<style>
		<?php include ('css/style-main.css'); ?>
		<?php include ('css/style-post.css'); ?>
	</style>
</head>

<!------------------------------------------BODY CONTENT--------------------------------------------->

<body>
	
	<?php $post_id = $_GET['post']; ?>
	<div class="container">
		<div class="show">
			<div class="show-left">
				<div class="show-left-content">
					<div class="left-content-top">
						<div class="first">
						<p><a href="index.php">Trang chủ</a></p>
						<p><a href="content.php">Bài Viết</a></p>
						</div>
					</div>
					<div class="left-content">

						<?php if ($post_type!=2) {
							echo "
						<h3>$post_name</h3>
						<p>$post_content</p>
						<div class='choice'>
						
						</div>";
						}else{
							$select_img = "SELECT * FROM images WHERE post_id = '$post_id'";
							$run_img = mysqli_query($conn,$select_img);

							

							echo "
										<h3>$post_name</h3>
							";

							while ($row_img = mysqli_fetch_array($run_img)) {
								$img_name = $row_img['img_name'];

								echo "
								<a href='images/$img_name' class='fancybox' data-fancybox='gallery1'>
								<img src='images/$img_name'>
								</a>";

							}
							
						}

						?>
						
						</div>
					</div>
			<hr  style="height:1px; border:none; color:grey; background-color:grey;">
			<!-- <div class="post-info"><p id="post-info"> 
							
						</p>
						</div> -->
		<div class="row">

			
			
        	

        	<!-----------------------------POP UP ARE YOU SURE???------------------>

        	<form method="POST" id="popup" style="text-align: center; border: 3px solid #A0DAA9; border-radius: 10px; background: #EFE1CE;">
        		<input type="hidden" name="comment_id_2" id="comment_id_2">
        		<p style="color: black;"><b>Bạn có chắc là muốn tiếp tục không?</b></p>
        		<button class="btn" type="submit" name="submit_2" id="submit_2" value="submit_2">Có</button>
        		<button class="btn" type="button" onclick="popupToggle();">Không</button>
        	</form>

        	<!--------------------------END POP UP ARE YOU SURE???------------------>

        	<!----------------------------POP UP REPLY------------------------------->
        	
        	<form class="modal fade" id="replyPage" method="POST" action="process/signin.php">
			  <div class="modal-dialog">
			    <div class="modal-content">
			      
			      <div class="modal-header text-center">
			        <h3 class="modal-title dark-grey-text font-weight-bold" style="color: black;">Trả lời</h3>
			        <button type="button" class="close" data-dismiss="modal" aria-lable="close">&times;</button>
			      </div>

			      <div class="modal-body mx-4">
			        <div class="md-form">
			          <textarea class="form-control" name="comment_content" id="comment_content" placeholder="Nhập bình luận vào đây" cols="30" rows="5"></textarea><br>
            	
		            	<input type="hidden" name="comment_user_id" id="comment_user_id" value="<?php echo($_SESSION['userid']); ?>" >
						
						<input type="hidden" name="comment_name" id="comment_name" value="<?php echo ($_SESSION['useruid']); ?>" >
						
						<input type="hidden" name="comment_product_id" id="comment_product_id" value="<?php 
						$comment_product_id = $_GET['post']; echo ($comment_product_id);?>" >

						<input type="hidden" name="comment_id" id="comment_id_3" value="0" >

			        </div>


			        <div class="text-center mb-3">
			          <button type="submit" name="submit" class="btn btn-primary btn-block z-depth-1a">Thêm bình luận</button>
			        </div>

			      </div>
			    </div>
			    </div> 
			  </form>

			  <!----------------------------END POP UP REPLY------------------------------->

			  <!----------------------------POP UP EDIT------------------------------------>
			  <form class="modal fade" id="editPage" method="POST" action="process/signin.php">
			  <div class="modal-dialog">
			    <div class="modal-content">
			      
			      <div class="modal-header text-center">
			        <h3 class="modal-title dark-grey-text font-weight-bold" style="color: black;">Sửa</h3>
			        <button type="button" class="close" data-dismiss="modal" aria-lable="close">&times;</button>
			      </div>

			      <div class="modal-body mx-4">
			        <div class="md-form">
			          <textarea class="form-control" name="comment_content" id="comment_content4" placeholder="Nhập bình luận vào đây" cols="30" rows="5"></textarea><br>
            	
		            	<input type="hidden" name="comment_user_id" id="comment_user_id" value="<?php echo($_SESSION['userid']); ?>" >
						
						<input type="hidden" name="comment_name" id="comment_name" value="<?php echo ($_SESSION['useruid']); ?>" >
						
						<input type="hidden" name="comment_product_id" id="comment_product_id" value="<?php 
						$comment_product_id = $_GET['post']; echo ($comment_product_id);?>" >

						<input type="hidden" name="comment_id" id="comment_id_4" value="0" >

			        </div>


			        <div class="text-center mb-3">
			          <button type="submit" name="submit" class="btn btn-primary btn-block z-depth-1a">Sửa bình luận</button>
			        </div>

			      </div>
			    </div>
			    </div> 
			  </form>



			  <!---------------------------------END POP UP EDIT--------------------------->

			  <!-------------------------------------------REPORT------------------------------->

				<form class="modal fade" id="report" method="POST">
				  <div class="modal-dialog">
				    <div class="modal-content">
				      
				      <div class="modal-header text-center">
				        <h3 class="modal-title dark-grey-text font-weight-bold">Báo cáo</h3>
				        <button type="button" class="close" data-dismiss="modal" aria-lable="close">&times;</button>
				      </div>

				      <div class="modal-body mx-4">
				        
				        <div class="md-form">
				         	<input type="hidden" name="report_id" value="<?php echo($_GET['post']) ?>">
				         	<p>
				         		Báo cáo bài viết có nội dung bao lực, quấy rối, vấn đề tình dục,...
				         	</p>
				        </div>
				        <div class="md-form">
				         	<p>
				         		p/s: Tên người báo cáo sẽ không được lưu lại.
				         	</p>
				        </div>


				      </div>
				      
				      <div class="modal-footer mx-4">
				      	<div class="text-center mb-3">
				          <button type="submit" name="submit" class="btn btn-primary btn-block z-depth-1a">Báo cáo</button>
				        </div>
				      </div>
				    </div>
				    </div> 
				  </form>
  
  <!---------------------------------------------------END REPORT------------------------------------->

        	<span id="comment_message"></span>
    	</div>
    	
	</div>
	<!--------------------------------------RIGHT-------------------------------->

			<div class="show-right">
				
				<div class="show-right-content">
					<div class="right-content">
						<div class="loader-display">
							
    					</div>
						<div id="avatar"></div>
						<?php
						 if (isset($_SESSION['userid'])){
						 if ($user_name == $_SESSION['useruid']) { ?>
							<h4 style="text-align: center;"><a class="user-post" href="account.php"><?php echo "$user_name"; ?></a></h4>
						<?php } else { ?>
						<h4 style="text-align: center;"><a class="user-post" href="user.php?user=<?php echo $post_user_id; ?>"><?php echo "$user_name"; ?></a></h4>
						<?php } 
						}else{ ?>
							<h4 style="text-align: center;"><a class="user-post" href="user.php?user=<?php echo $post_user_id; ?>"><?php echo "$user_name"; ?></a></h4>
						<?php
						}

						?>
						<?php if ($post_type == 3) {
						 	echo '<div class="post-info"><p><i class="far fa-eye" style="color: lightgreen;"></i>  
 									'.$post_view_up.'</p></div>';
						}else { echo ' <div class="post-info"><p id="post-info"> 
							
						</p>
						</div>';}
						?>
						<div class="post-date"><p>
							Đã đăng: 
								<?php 	
									$post_date = new DateTime($post_date2);
									echo $post_date->format('Y-m-d');
								?>		
							</p>

							<script>
								
							</script>
						</div>

						<div style="margin: auto; text-align: center;" id="display-save">
							
						</div>
						<div style="margin: auto; text-align: center;">
							<a href="javascript:void(0)" class="report">Báo cáo</a>
						</div>
					</div>
					
				</div>

				
		</div>
	</div>
</div>
	<div class="container">
		<div class="show">
			<div class="show-left">
				<div class="row">
					<form class="col-md-12" method="POST" id="comment_form">
				        		<?php if (isset($_SESSION['userid'])) {
							        	echo '
				            	<textarea class="form-control" name="comment_content" id="comment_content" placeholder="Nhập bình luận vào đây" cols="30" rows="2"></textarea><br>';
				            	}?>
				            	
				            	<input type="hidden" name="comment_user_id" id="comment_user_id" value="<?php echo($_SESSION['userid']); ?>" >
								
								<input type="hidden" name="comment_name" id="comment_name" value="<?php echo ($_SESSION['useruid']); ?>" >
								
								<input type="hidden" name="comment_product_id" id="comment_product_id" value="<?php 
								$comment_product_id = $_GET['post']; echo ($comment_product_id);?>" >

								<input type="hidden" name="comment_id" id="comment_id" value="0" >

								<?php if (isset($_SESSION['userid'])) {
							        	echo '
								<button id="submit" type="submit" name="submit" style="float:right" class="btn-primary btn">Thêm bình luận</button>
								';}?>
								<br>
								<br>
								
				    </form>
				</div>
				<div class="row comment-content">
		        	<div class="col-md-12">
		            	<div id="comment_total">
		            		<div id="num_comment">
		            			
		            		</div>
		            		<div>
							 	<select id="filter">
							 		<option value="all">Tất cả bình luận</option>
							 		<option value="point">Phù hợp nhất</option>
							 		<option value="oldest">Bình luận cũ nhất</option>
							 	</select>
							 </div>
		            	</div>
		            		<div class="userComments" id="display_comment">

		            		</div>
		        	</div>
		    	</div>
		    </div>
		    <div class="show-right show-right-2">
		    	
		    </div>
		</div>
    </div>	

			<script>
				
				
				function like_update(){
							$.ajax({
							url:'process/update_count.php',
							method:'post',
							data:{type: 1, id: <?php echo $post_id; ?>,
							vote_user_id: <?php if (isset($_SESSION['userid'])) { echo($_SESSION['userid']);}

							else{
								echo "0";
							}

							 ?>
							},
							success:function(){
								
						        
    
								load_vote_total();
								
							}
						});
					}

					function dislike_update(){
							$.ajax({
							url:'process/update_count.php',
							method:'post',
							data:{type: -1, id: <?php echo $post_id; ?>,
							vote_user_id: <?php if (isset($_SESSION['userid'])) { echo($_SESSION['userid']);}

							else{
								echo "0";
							}

							 ?>
							},
							success:function(){
								
								
								load_vote_total();
						
							}
						});
					}

					function display_loader(){
						$.ajax({

							url:"process/loader_display.php",
							method:"POST",
							success:function(data){

								$('.loader-display').html(data);
							}
						})
					}

					function load_vote_total(){
								var post_id= <?php echo $post_id; ?>;
							 	$.ajax({
							   url:"process/vote_total.php",
							   data: {post_id : <?php echo $post_id; ?>},
							   method:"POST",
							   success:function(data)
							   {
							 	
							   	$(".loader-display").addClass("success");
							    $('#post-info').html(data);
							    update_point(post_id);

							   }
							  })
							 }
							 load_vote_total();

					
					jQuery('#like').bind('dblclick',function(e){
					    e.preventDefault();
					})

					jQuery('#dislike').bind('dblclick',function(e){
					    e.preventDefault();
					})

			</script>
	<!--------------------------------------------------SCRIPT POPUP---------------------------------------------->
	<script>
	function popupToggle(){
			const popup = document.getElementById('popup');
			popup.classList.toggle('active')
		}
	</script>
	<!-----------------------------------------------END SCRIPT POPUP--------------------------------------------->


	<!--------------------------------------------------SCRIPT AJAX----------------------------------------------->

				<script>
					<?php $post_id=$_GET['post']; 
						if (isset($_SESSION['userid']))
				   			{
						  $user_id=$_SESSION['userid'];
							}
					?>
				$(document).ready(function(){
		    
				 
				 $('#comment_form').on('submit', function(event){
				  event.preventDefault();
				  var form_data = $(this).serialize();
				  $.ajax({
				   url:"process/add_comment.php",
				   method:"POST",
				   data:form_data,
				   dataType:"JSON",
				   success:function(data)
				   {
				    if(data.error != '')
				    {
				     $('#comment_form')[0].reset();
				    // $('#comment_message').html(data.error);
				     $('#comment_id').val('0');
				     load_comment();
				     load_comment_total();
				    }
				   }
				  })
				 });

				 $('#replyPage').on('submit', function(event){
				  event.preventDefault();
				  var form_data = $(this).serialize();
				  $.ajax({
				   url:"process/add_comment.php",
				   method:"POST",
				   data:form_data,
				   dataType:"JSON",
				   success:function(data)
				   {
				    if(data.error != '')
				    {
				     $('#comment_form')[0].reset();
				     // $('#comment_message').html(data.error);
				     $('#comment_id').val('0');
				     load_comment();
				     load_comment_total();
				     $('#replyPage').modal('hide');
				    }
				   }
				  })
				 });

				 $('#editPage').on('submit', function(event){
				  event.preventDefault();
				  var form_data = $(this).serialize();
				
				  $.ajax({
				   url:"process/comment_edit.php",
				   method:"POST",
				   data:form_data,
				   
				   success:function()
				   {
				 	
					$('#editPage').modal('hide');
					load_comment();

				   }
				  })
				 });
				 

				 $('#popup').on('submit', function(event){
				  event.preventDefault();
				  var form_data = $(this).serialize();
				  $.ajax({
				   url:"process/comment_delete.php",
				   method:"POST",
				   data:form_data,
				   success:function()
				   {
				   	
				    
				    load_comment();
				    popupToggle();
				    load_comment_total();
					
				   }
				  })
				 });

				 $('#report').on('submit', function(event){
				  event.preventDefault();
				  var form_data = $(this).serialize();
				  $.ajax({
				   url:"process/report.php",
				   method:"POST",
				   data:form_data,
				   success:function()
				   {
				   	
				    $('#report').modal('hide');
					
				   }
				  })
				 });

				 

				 function load_comment()
				 {
				  $.ajax({
				   url:"process/fetch_comment.php",
				   data: {product_id : <?php echo $post_id; ?>,
				   	comment_user_id: <?php if (isset($_SESSION['useruid'])){echo($_SESSION['userid']);}
				   	else{ echo "0";}

				   	 ?>},
				   method:"POST",
				   success:function(data)
				   {
				    $('#display_comment').html(data);
				    load_comment_total();
				   }
				  })
				 }
				 load_comment();

				 function load_comment2()
				 {
				  $.ajax({
				   url:"process/fetch_comment2.php",
				   data: {product_id : <?php echo $post_id; ?>,
				   	comment_user_id: <?php if (isset($_SESSION['useruid'])){echo($_SESSION['userid']);}
				   	else{ echo "0";}

				   	 ?>},
				   method:"POST",
				   success:function(data)
				   {
				    $('#display_comment').html(data);
				    load_comment_total();
				   }
				  })
				 }

				 function load_comment3()
				 {
				  $.ajax({
				   url:"process/fetch_comment3.php",
				   data: {product_id : <?php echo $post_id; ?>,
				   	comment_user_id: <?php if (isset($_SESSION['useruid'])){echo($_SESSION['userid']);}
				   	else{ echo "0";}

				   	 ?>},
				   method:"POST",
				   success:function(data)
				   {
				    $('#display_comment').html(data);
				    load_comment_total();
				   }
				  })
				 }
				 $('#filter').change(function() {
				 	var value = $(this).val();
				    if (value == 'all') {
				        load_comment();
				    }
				    if (value == 'point') {
				       load_comment2();
				    }
				    if (value == 'oldest') {
				       	load_comment3();
				    }
				});

				 function load_comment_total(){
				 	$.ajax({
				   url:"process/comment_total.php",
				   data: {product_id : <?php echo $post_id; ?>},
				   method:"POST",
				   success:function(data)
				   {
				    $('#num_comment').html(data);

				   }
				  })
				 }

				 function load_save_button(){
				 	$.ajax({
				   url:"process/load_save_button.php",
				   data: {post_id: <?php echo $post_id; ?>,
				   	user_id: <?php 
				   		if (isset($_SESSION['userid']))
				   			{
				   				echo $_SESSION['userid'];
				   			}
				   		else{ echo "0";} ?>

				   },
				   method:"POST",
				   success:function(data)
				   {
				    $('#display-save').html(data);

				   }
				  })
				 }
				 load_save_button();

				 // function load_vote_total(){
				 // 	$.ajax({
				 //   url:"process/vote_total.php",
				 //   data: {post_id : <?php //echo $post_id; ?>},
				 //   method:"POST",
				 //   success:function(data)
				 //   {
				 //    $('#post-info').html(data);
				    
				 //   }
				 //  })
				 // }
				 // load_vote_total();

				 <?php
				 if (isset($_SESSION['userid'])) { echo "
				 $(document).on('click', '.reply', function(){
				  var comment_id = $(this).attr('id');
				  $('#comment_id_3').val(comment_id);
				  $('#replyPage').modal('show');
				  });

				  $(document).on('click', '.save-post', function(){
				  	$.ajax({
				   url:'process/save_total.php',
				   data: {post_id: $post_id,
				   		  user_id: $user_id,
				   		  stat: 1
				   },
				   method:'POST',
				   success:function(data)
				   {
				     load_save_button();

				   }
				  })
				  });

				  $(document).on('click', '.dissave-post', function(){
				  	$.ajax({
				   url:'process/save_total.php',
				   data: {post_id: $post_id,
				   		  user_id: $user_id,
				   		  stat: 0
				   },
				   method:'POST',
				   success:function(data)
				   {
				     load_save_button();

				   }
				  })
				  });  

				  ";
				}else{
					echo "
				 $(document).on('click', '.reply', function(){
				  pop_up_fail();
				  });


				 $(document).on('click', '.save-post', function(){
				  	pop_up_fail();
				 }); 

				 $(document).on('click', '.dissave-post', function(){
				  	pop_up_fail();
				 });
				  ";
				}
				 ?>

				 $(document).on('click', '.delete', function(){
				  var comment_id = $(this).attr("id");
				  $('#comment_id_2').val(comment_id);
				  popupToggle();
				 });

				 $(document).on('click', '.edit', function(){
				  var comment_id = $(this).attr("id");
				  var comment_content = $(this).attr("value");
				  $('#comment_id_4').val(comment_id);
				  $('#comment_content4').val(comment_content);
				  $('#editPage').modal('show');
				 });

				 $(document).on('click', '#like', function(){
				 	$(".loader-display").removeClass("success");
				  	display_loader();
				 });

				 $(document).on('click', '#dislike', function(){
				 	$(".loader-display").removeClass("success");
				  	display_loader();
				 });
				 
				 $(document).on('click', '.report', function(){
				 	$('#report').modal('show');
				 });
				 function load_point(){
				 	var post_id= <?php echo $post_id; ?>;
				 	update_point(post_id);
				 }
				 load_point();

				 function update_point(query){
		        	$.ajax({
						   url:"process/update_point.php",
						   data: {
						   				query:query
						    },
						   method:"POST",
						   success:function(data)
						   {
						   	

						   }
						  })
		        }
				  

				});

				function pop_up_fail(){
                swal("Không thể thực hiện thao tác này", "Vui Lòng Đăng Nhập Để Thực Hiện Thao Tác","error");
                }



				
				</script>


	<!-- <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script> -->
  	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
  	<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js"></script>

</body>
</html>