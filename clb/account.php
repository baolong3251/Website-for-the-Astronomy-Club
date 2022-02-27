<?php
    session_start();
    require 'connect.php';
    include ('functions.php');
    // update_user_point();
    update_user_rank();

    $user_id = $_SESSION['userid'];

    $select_account = "SELECT * FROM users WHERE user_id = '$user_id'";
    $run_account = mysqli_query($conn,$select_account);
    $row_account = mysqli_fetch_array($run_account);
    $user_name = $row_account['user_name'];
    $user_point = $row_account['user_point'];


 ?>
<!DOCTYPE html>
<html>
<head>

  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
	<title></title>

  <style>

  	<?php include 'css/style-main.css'; ?>
  	
  	<?php include 'css/style-account.css'; ?>

  </style>
</head>
<body>
	<!-- <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script> -->
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js"></script>

  		
  		
  			<div class="title">

          <nav class="nav-bar home-nav-bar navbar navbar-expand-lg navbar-light">
             <button aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation" class="navbar-toggler" data-target="#navbarSupportedContent" data-toggle="collapse" type="button"><span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse justify-content-end" id="navbarSupportedContent">
                <ul class="navbar-nav">
                  <li class="nav-item active">
                    <a class="nav-link" href="index.php">Trang chủ <span class="sr-only">(current)</span></a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="content.php">Bài viết</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="upload.php">Tạo bài viết</a>
                  </li>
                </ul>
            </div>
          </nav>

	  			<div class="account-title">
		  				<span class="use-icon"><a href="" id="img-out" data-toggle="modal" data-target="#account_img"></a></span>
		  			
		  			<div class="account-stuff">	
		  				<div class="account-name"><h3 id="account-name"></h3><a href="javascript:void(0)" class="name-edit"><i class="fas fa-edit" style="margin-top: 10px;"></i></a></div>
              <div class="account-full-name"><h5 id="account-full-name">full name</h5><a href="javascript:void(0)" class="fullname-edit"><i class="fas fa-edit" style="margin-top: 4px;"></i></a></div>
		  				<div class="account-point">Điểm: <?php echo "$user_point"; ?></div>
		  			</div>
  				</div>

  			<div class="tab-nav">
        		<ul class="nav nav-pills mb-3 mt-3" id="pills-tab" role="tablist">
      			  <li class="nav-item" role="presentation">
      			    <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true">Bài đã đăng</a>
      			  </li>
      			  <li class="nav-item" role="presentation">
      			    <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="false">Bài đã thích</a>
      			  </li>
      			  <li class="nav-item" role="presentation">
      			    <a class="nav-link" id="pills-contact-tab" data-toggle="pill" href="#pills-contact" role="tab" aria-controls="pills-contact" aria-selected="false">Bài đã lưu</a>
      			  </li>
      			</ul>
			  </div>

  			</div>


      <div class="tabs mt-2">
    		<div  class="container">
    		  <div class="tab-content" id="pills-tabContent">
    		    <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
              
              <div id="display_account_post">
          		  
              </div>

    		    </div>

    		  <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
            <div id="display_account_like">
              
            </div>  
          </div>
    		  
          <div class="tab-pane fade" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab">
            <div id="display_account_save">
              
            </div>
          </div>
    		
        </div>
    	</div>
    </div>



    <!-------------------------------------------POP UP IMG----------------------------->

    <form class="modal fade" id="account_img" style="color: black;" method="POST">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header text-center">
          <h4 class="modal-title text-center font-weight-bold" style="color: black;">Chỉnh sửa hình</h4>
          <button type="button" class="close" data-dismiss="modal" aria-lable="close">&times;</button>
        </div>
        <div class="modal-body mx-3">
            <input type="file" name="image" id="image">
            <input type="hidden" name="user_id_account" value="<?php echo $user_id; ?>">
          </div>

        <div class="modal-footer d-flex justify-content-center">
          <button class="btn btn-primary" type="submit" name="submit2">Xác nhận</button>
        </div>

      </div>
    </div>
  </form>	

  <!-------------------------------------------END POP UP IMG----------------------------->


  <!-------------------------------------------POP UP NAME----------------------------->

    <form class="modal fade" id="edit_account_name" style="color: black;" method="POST">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header text-center">
          <h4 class="modal-title text-center font-weight-bold" style="color: black;">Chỉnh sửa tên tài khoản</h4>
          <button type="button" class="close" data-dismiss="modal" aria-lable="close">&times;</button>
        </div>
        <div class="modal-body mx-3" id="account_popup_name">
            
          </div>

        <div class="modal-footer d-flex justify-content-center">
          <button class="btn btn-primary" type="submit" name="submit2">Xác nhận</button>
        </div>

      </div>
    </div>
  </form> 

  <!-------------------------------------------END POP UP NAME----------------------------->

  <!-------------------------------------------POP UP FULL NAME----------------------------->

    <form class="modal fade" id="edit_account_fullname" style="color: black;" method="POST">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header text-center">
          <h4 class="modal-title text-center font-weight-bold" style="color: black;">Chỉnh sửa tên đầy đủ</h4>
          <button type="button" class="close" data-dismiss="modal" aria-lable="close">&times;</button>
        </div>
        <div class="modal-body mx-3" id="account_popup_fullname">
            
          </div>

        <div class="modal-footer d-flex justify-content-center">
          <button class="btn btn-primary" type="submit" name="submit2">Xác nhận</button>
        </div>

      </div>
    </div>
  </form> 

  <!-------------------------------------------END POP UP FULL NAME----------------------------->

  <!-------------------------------------------POP UP ARE YOU SURE----------------------------->

    <form class="modal fade" id="are_you_sure" style="color: black;" method="POST">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header text-center">
            <button type="button" class="close" data-dismiss="modal" aria-lable="close">&times;</button>
          </div>
          <div class="modal-body mx-3">
              <label>Bạn có chắc là muốn tiếp tục không?</label>
              <input type="hidden" name="post_id_2" id="post_id_2">
            </div>

          <div class="modal-footer d-flex justify-content-center">
            <button class="btn btn-primary" type="submit" name="submit2">Xác nhận</button>
          </div>

        </div>
      </div>
    </form> 

  <!-------------------------------------------END POP UP ARE YOU SURE----------------------------->




  <!--------------------------------------------AJAX-------------------------------------->

  <script>

      $(document).ready(function(){
               
               $('#account_img').on('submit', function(event){
                  event.preventDefault();
                  var image_name = $('#image').val();
                  if(image_name == '')
                  {
                   alert("Please Select Image");
                   return false;
                  }
                  else
                  {
                   var extension = $('#image').val().split('.').pop().toLowerCase();
                   if(jQuery.inArray(extension, ['gif','png','jpg','jpeg']) == -1)
                   {
                    alert("Invalid Image File");
                    $('#image').val('');
                    return false;
                   }
                   else
                   {
                    $.ajax({
                     url:"process/upload_icon.php",
                     method:"POST",
                     data:new FormData(this),
                     contentType:false,
                     processData:false,
                     success:function(data)
                     {
                      load_account();
                      $('#account_img').modal('hide');
                      fetch_data();
                      $('#account_img')[0].reset();
                     }
                    });
                   }
                  }

               });
               load_account();

               function load_account(){
                $.ajax({
                 url:"process/load_account.php",
                 data: {user_id : <?php echo $user_id; ?>},
                 method:"POST",
                 success:function(data)
                 {
                  $('#img-out').html(data);

                 }
                })
               }

               load_account_like();
               function load_account_like(){
                $.ajax({
                  url:"process/load_account_like.php",
                  data: {user_id: <?php echo $user_id; ?>},
                  method: "POST",
                  success:function(data){
                    $('#display_account_like').html(data);
                  }
                })
               }

               $('#are_you_sure').on('submit', function(event){
                event.preventDefault();
                var form_data = $(this).serialize();
                $.ajax({
                 url:"process/account_post_delete.php",
                 method:"POST",
                 data:form_data,
                 success:function()
                 {
                  
                  load_account_post();
                  update_num_post();
                  $('#are_you_sure').modal('hide');
                
                 }
                })
               });
               load_account_post();

               function load_account_post(){
                $.ajax({
                 url:"process/load_account_post.php",
                 data: {user_id : <?php echo $user_id; ?>},
                 method:"POST",
                 success:function(data)
                 {
                  $(".loader-display").addClass("success");
                  $('#display_account_post').html(data);
                  load_account_like();


                 }
                })
               }
               load_account_post();

               $(document).on('click', '.delete', function(){
                var post_id = $(this).attr("id");
                $('#post_id_2').val(post_id);
                $('#are_you_sure').modal('show');
               });

               $(document).on('click', '.delsave', function(){
                    var post_id = $(this).attr("id");
                    var p_id = post_id.slice(2);
                    
                        
                    $.ajax({
                      url:'process/removesave.php',
                      method:'post',
                      data:{ user_id: '<?php echo $user_id; ?>',
                      p_id2: p_id
                    },
                    success:function(){
                      
                      load_account_save();
                              
                      }
                    });
                      
                        
                  });

               function load_account_save(){
                $.ajax({
                 url:"process/load_account_save.php",
                 data: {user_id : <?php echo $user_id; ?>},
                 method:"POST",
                 success:function(data)
                 {
                  $(".loader-display").addClass("success");
                  $('#display_account_save').html(data);
                  
                 }
                })
               }
               load_account_save();

               /*------------------------------------------------------LIKE DISLIKE---------------------*/

               function display_loader(){
                $.ajax({

                  url:"process/loader_display.php",
                  method:"POST",
                  success:function(data){

                    $('.loader-display').html(data);
                  }
                })
              }


              $(document).on('click', '.like', function(){
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
                      
                          
                      load_account_save();
                      load_account_post();
                      
                    }
                  });
                }
                      });

              $(document).on('click', '.dislike', function(){
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
                      
                      load_account_save();
                      load_account_post();
                  
                    }
                  });
                }
               });

              /*---------------------------------------------AJAX NAME--------------------------------*/

              $(document).on('click', '.name-edit', function(){
                load_popup_name();
                $('#edit_account_name').modal('show');
              });

              function load_popup_name(){
                $.ajax({
                 url:"process/load_account_popup_name.php",
                 data: {user_id : <?php echo $user_id; ?>},
                 method:"POST",
                 success:function(data)
                 {
                  
                  $('#account_popup_name').html(data);
                  

                 }
                })
               }

              function load_account_name(){
                $.ajax({
                 url:"process/load_account_name.php",
                 data: {user_id : <?php echo $user_id; ?>},
                 method:"POST",
                 success:function(data)
                 {
                  
                  $('#account-name').html(data);
                  

                 }
                })
               }
               load_account_name();

               $('#edit_account_name').on('submit', function(event){
                event.preventDefault();
                var form_data = $(this).serialize();
                $.ajax({
                 url:"process/edit_account_name.php",
                 method:"POST",
                 data:form_data,
                 success:function()
                 {
                  
                  $('#edit_account_name').modal('hide');
                  load_account_name();
                  
                  
                 }

                })
               });

            /*---------------------------------------------AJAX FULL NAME--------------------------------*/

               $(document).on('click', '.fullname-edit', function(){
                load_popup_fullname();
                $('#edit_account_fullname').modal('show');
              });

               function load_popup_fullname(){
                $.ajax({
                 url:"process/load_account_popup_fullname.php",
                 data: {user_id : <?php echo $user_id; ?>},
                 method:"POST",
                 success:function(data)
                 {
                  
                  $('#account_popup_fullname').html(data);
                  

                 }
                })
               }


               function load_account_fullname(){
                $.ajax({
                 url:"process/load_account_fullname.php",
                 data: {user_id : <?php echo $user_id; ?>},
                 method:"POST",
                 success:function(data)
                 {
                  
                  $('#account-full-name').html(data);
                  

                 }
                })
               }
               load_account_fullname();

               $('#edit_account_fullname').on('submit', function(event){
                event.preventDefault();
                var form_data = $(this).serialize();
                $.ajax({
                 url:"process/edit_account_fullname.php",
                 method:"POST",
                 data:form_data,
                 success:function()
                 {
                  
                  $('#edit_account_fullname').modal('hide');
                  load_account_fullname();
                  
                  
                 }

                })
               });

               function update_num_post(){
                $.ajax({
                 url:"process/update_num_post.php",
                 data: {},
                 method:"POST",
                 success:function()
                 {
                 }
                })
               }
      });    

            function pop_up_fail(){
                swal("Không Sửa Được", "Tên tài khoản đã được sử dụng","error");
            }
  
  </script>

</body>
</html>