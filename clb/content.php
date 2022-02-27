<?php
  session_start();
  include("functions.php");
  // update_user_point();
  update_user_rank();
  auto_del();
  update_chart_view();
?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title></title>
  
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.11.2/css/all.css">
	 
	<link rel="stylesheet" href="css/style-main.css">
	 
	<link rel="stylesheet" href="jarallax.css">
	 
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css">
	 
	<link href="https://fonts.googleapis.com/css2?family=Merienda&display=swap" rel="stylesheet">
	 
	<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;700&display=swap" rel="stylesheet">
	 
	<!-- <link href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.2/animate.min.css" rel="stylesheet"> -->

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>

	<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
	 
	<script defer src="https://use.fontawesome.com/releases/v5.11.1/js/all.js"></script>

	<style>
		<?php include 'css/style-content.css'; ?>
	</style>
</head>
<body>
	  <!-- <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script> -->
	  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
	  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js"></script>
	
	<div class="container">
		<div class="show">
			<div class="show-left">
				<div class="show-left-content">
					<div class="left-content-top">
						<div class="first">
						<p><a href="index.php">Trang chủ</a></p>
						<p><a <?php if (isset($_SESSION['userid'])){
				            echo "href='account.php'";
				          }else{
				            echo "href='#' onclick='pop_up_fail();'";
				          } ?>>Tài Khoản</a></p>

						<p><a <?php if (isset($_SESSION['userid'])){
				            echo "href='upload.php'";
				          }else{
				            echo "href='#' onclick='pop_up_fail();'";
				          } ?>>Tạo Bài Viết</a></p>
				    <p><a href="javascript:void(0)" id="post">Bài viết</a></p>      
				    <p><a href="javascript:void(0)" id="new-post">Bài viết mới</a></p>
						</div>
						<?php if (!isset($_GET['event'])) {	?>
						<div class="second">
							<form class="d-flex">
					            <input class="form-control me-2" type="search" id="search_post" placeholder="Tìm kiếm" aria-label="Search">
					            
					    </form>
						</div>
						<?php } ?>
					</div>
					<div id="show-left-content">
						
						<input type="hidden" id="post_id" name="">
					</div>	
				</div>
			</div>

			<script>
				

					

					function display_loader(){
						$.ajax({

							url:"process/loader_display.php",
							method:"POST",
							success:function(data){

								$('.loader-display').html(data);
							}
						})
					}
					display_loader();

			</script>
			<!--------------------------------------RIGHT-------------------------------->

			<div class="show-right">
				
				<div class="show-right-content">
					<?php 
					
					if (isset($_GET['event'])) {
						echo "<h4>Bài viết mới nhất</h4>";

						require 'connect.php';
						mysqli_set_charset($conn,'UTF8');
						$select_event = "SELECT * FROM post where post_type != 3 ORDER BY 1 DESC LIMIT 0,4";
						$run_event = mysqli_query($conn,$select_event);
						while($row_event = mysqli_fetch_array($run_event)){
							$post_name = $row_event['post_name'];
							$post_id = $row_event['post_id'];
							echo '
								<div class="right-content">
									<a href="posts.php?post='.$post_id.'">'.$post_name.'</a>
								
								</div>
							';
						

					}
				}else{

					echo '<h4>Sự kiện</h4>';
					
						require 'connect.php';
						mysqli_set_charset($conn,'UTF8');
						$select_event = "SELECT * FROM post where post_type = 3";
						$run_event = mysqli_query($conn,$select_event);
						while($row_event = mysqli_fetch_array($run_event)){
							$post_name = $row_event['post_name'];
							$post_id = $row_event['post_id'];
							echo '
								<div class="right-content">
									<a href="posts.php?post='.$post_id.'">'.$post_name.'</a>
								
								</div>
							';
						}

					}
					?>
					
				</div>


				<div class="show-right-content">
					<h4>Nổi bật trong ngày</h4>
					<?php 
						require 'connect.php';
						mysqli_set_charset($conn,'UTF8');
						$select_post = "SELECT * FROM post where post_stat != 1 AND post_type != 3 ORDER BY post_view DESC LIMIT 0,5";
						$run_post = mysqli_query($conn,$select_post);
						while ($row_post = mysqli_fetch_array($run_post)) {
							$post_name = $row_post['post_name'];
							$post_id = $row_post['post_id'];
							$post_date = $row_post['post_date'];
							$time_ago = time_elapsed_string($post_date);

							if(strchr("$time_ago","phút") || strchr("$time_ago","giờ") || strchr("$time_ago","giây")){
							echo '
								<div class="right-content">
									<a href="posts.php?post='.$post_id.'">'.$post_name.'</a>
								</div>
							';
							}
						}

					?>
					
				</div>

				<div class="show-right-content">
					<h4>Chủ đề</h4>
					<?php 
					require 'connect.php';
					mysqli_set_charset($conn,'UTF8');
						$select_cat = "SELECT * FROM post_categories where post_type != 3";
						$run_cat = mysqli_query($conn,$select_cat);
						
						while ($row_cat = mysqli_fetch_array($run_cat)) {
							$post_cat_name = $row_cat['post_cat_name'];
							$post_cat_id = $row_cat['post_type'];
							echo '
								<div class="right-content">
									<a href="content.php?cat='.$post_cat_id.'" class="post-type" id="t-'.$post_cat_id.'">'.$post_cat_name.'</a>
								</div>
							';
						}

					?>
					
				</div>
				

			</div>
		</div>
	</div>

	<script>
         function pop_up_fail(){
            swal("Không thể thực hiện thao tác này", "Vui Lòng Đăng Nhập Để Thực Hiện Thao Tác","error");
          }

          $(document).ready(function(){
			$(document).on('click', '.like', function(){
          			var post_id = $(this).attr("id");
          			var search = $('#search_post').val();
          			$('#post_id').val(post_id);
				 	$(".loader-display").removeClass("success");
				  	display_loader();
				  	like_update();
				 
          		function like_update(){
							$.ajax({
							url:'process/update_count.php',
							method:'post',
							data:{type: 1, id: post_id,
							vote_user_id: <?php if (isset($_SESSION['userid'])) { echo($_SESSION['userid']);}

							else{
								echo "0";
							}

							 ?>
							},
							success:function(){
								
						        
    
								load_like_dislike(post_id);
								update_point(post_id);
							}
						});
					}
          			});

			$(document).on('click', '.likecat', function(){
          			var post_id = $(this).attr("id");
          			$('#post_id').val(post_id);
				 	$(".loader-display").removeClass("success");
				  	display_loader();
				  	like_update();
				 
          		function like_update(){
							$.ajax({
							url:'process/update_count.php',
							method:'post',
							data:{type: 1, id: post_id,
							vote_user_id: <?php if (isset($_SESSION['userid'])) { echo($_SESSION['userid']);}

							else{
								echo "0";
							}

							 ?>
							},
							success:function(){
								
						        
    
								load_like_dislike(post_id);
								update_point(post_id);
							}
						});
					}
          			});

				$(document).on('click', '.dislike', function(){
				 	var post_id = $(this).attr("id");
				 	var search = $('#search_post').val();
				 	$('#post_id').val(post_id);
				 	$(".loader-display").removeClass("success");
				  	display_loader();
				  	dislike_update();
				  	function dislike_update(){
							$.ajax({
							url:'process/update_count.php',
							method:'post',
							data:{type: -1, id: post_id,
							vote_user_id: <?php if (isset($_SESSION['userid'])) { echo($_SESSION['userid']);}

							else{
								echo "0";
							}

							 ?>
							},
							success:function(){
								
								
								load_like_dislike(post_id);
								update_point(post_id);
							}
						});
					}
				 });

				$(document).on('click', '.dislikecat', function(){
				 	var post_id = $(this).attr("id");
				 	$('#post_id').val(post_id);
				 	$(".loader-display").removeClass("success");
				  	display_loader();
				  	dislike_update();
				  	function dislike_update(){
							$.ajax({
							url:'process/update_count.php',
							method:'post',
							data:{type: -1, id: post_id,
							vote_user_id: <?php if (isset($_SESSION['userid'])) { echo($_SESSION['userid']);}

							else{
								echo "0";
							}

							 ?>
							},
							success:function(){
								
								
								load_like_dislike(post_id);
								update_point(post_id);
						
							}
						});
					}
				 });

				$(document).on('click', '#new-post', function(){
				  	$.ajax({
				   url:"process/load_post_new.php",
				   data: {user_id : <?php if (isset($_SESSION['userid'])) { echo $_SESSION['userid'];} else echo "0";?>,
				   		  event:	<?php if (isset($_GET['event'])) {echo "3";} else echo "0"; ?>
				    },
				   method:"POST",
				   success:function(data)
				   {
				   	// $(".loader-display").addClass("success");
				    $('#show-left-content').html(data);

				   }
				  });
				 });

				$(document).on('click', '#post', function(){
				  	load_post();
				 });

				function load_like_dislike(query){
					$.ajax({
							url:'process/load_like_dislike.php',
							method:'post',
							data:{post_id: query,
							vote_user_id: <?php if (isset($_SESSION['userid'])) { echo($_SESSION['userid']);}

							else{
								echo "0";
							}

							 ?>
							},
							success:function(data){
								
								$(".loader-display").addClass("success");
								$('#show_like_dislike_'+query).html(data);
						
							}
						});
				}
				//-------------------------------------------FOR UPDATE POST_POINT
				// setInterval(function(){
				// 	$.ajax({
				// 		url:"process/update_post_point.php",
				// 		method:"POST",
				// 		data:{
							
				// 		},
						
				// 		success:function(){
							
				// 		}
				// 	});
				// }, 3600000);

				function up_point(){
					$.ajax({
						url:"process/update_post_point.php",
						method:"POST",
						data:{
							
						},
						
						success:function(){
							
						}
					});
				}
				up_point();

				});

          function load_post(query){
				 	$.ajax({
				   url:"process/load_post.php",
				   data: {user_id : <?php if (isset($_SESSION['userid'])) { echo $_SESSION['userid'];} else echo "0";?>,
				   		  event:	<?php if (isset($_GET['event'])) {echo "3";} else echo "0"; ?>,	
				   		  query:query
				    },
				   method:"POST",
				   success:function(data)
				   {
				   	$(".loader-display").addClass("success");
				    $('#show-left-content').html(data);

				   }
				  })
				 }
				 $('#search_post').keyup(function(){
	                var search = $(this).val();
	                if(search != '')
	                {
	                 load_post(search);
	                }
	                else
	                {
	                 load_post();
	                }
	               });
				<?php if (isset($_GET['cat'])) {
				echo "load_post_cat();";
				} else { 
				echo "load_post();";	
				}  ?>

		//------------------------------------------//

        //   $(document).on('click', '.post-type', function(){
        //         var cat_id_tmp = $(this).attr("id");
        //         var cat_id = cat_id_tmp.slice(2);
        //         $.ajax({
        //          url:"process/load_post_cat.php",  
        //          method:"POST",
        //          data:{
        //          	user_id : <?php if (isset($_SESSION['userid'])) { echo $_SESSION['userid'];} else echo "0";?>,
				   	// event:	<?php if (isset($_GET['event'])) {echo "3";} else echo "0"; ?>,
        //          	cat_id2: cat_id},
        //          success:function(data)
        //          {
        //           $('#show-left-content').html(data);
        //          }
        //         });
                
        //       });

        function load_post_cat(){
        	$.ajax({
                 url:"process/load_post_cat.php",  
                 method:"POST",
                 data:{
                 	user_id : <?php if (isset($_SESSION['userid'])) { echo $_SESSION['userid'];} else echo "0";?>,
				   	event:	<?php if (isset($_GET['event'])) {echo "3";} else echo "0"; ?>,
                 	cat_id2: <?php if (isset($_GET['cat'])) {echo $_GET['cat'];} else echo "0"; ?>},
                 success:function(data)
                 {
                  $(".loader-display").addClass("success");
                  $('#show-left-content').html(data);
                 }
                });
        }

        //------------------------------------------// 

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


				 

 	 </script>
 	 <script>
 	 	function pop_up_fail(){
                swal("Không Xem Được", "Vui Lòng Đăng Nhập Để Thực Hiện Thao Tác","error");
                }
 	 </script>

</body>
</html>