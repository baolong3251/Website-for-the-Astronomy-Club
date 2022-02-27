<?php 
	session_start();
	require 'connect.php';
    include("functions.php");

    $user_id = $_SESSION['userid'];
?>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js" crossorigin="anonymous"></script>
    
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
    
    <script src="http://cdn.ckeditor.com/4.6.2/full/ckeditor.js"></script>

    <link href="https://fonts.googleapis.com/css2?family=Merienda&display=swap" rel="stylesheet">
  
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;700&display=swap" rel="stylesheet">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.js"></script>

    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.css">

    <style>
        <?php include ('css/style-upload.css'); ?>  
    </style>
  </head>
  <body>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js"></script>
    <div class="container">
    <div class="choosing-tab">
        <a class="btn" href="index.php">Trang chủ</a>
        <a class="btn" href="content.php">Bài viết</a>
        <a class="btn" href="account.php">Tài khoản</a>
    </div>

    <!----------------------------------------------------TAB--------------------------------------------->
    <div class="tab-nav">
        <ul class="nav nav-pills mb-3 mt-3" id="pills-tab" role="tablist">

            <li class="nav-item" role="presentation">
                <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true"><?php if (isset($_GET['edit'])) { echo"Sửa bài";} else{ echo "Đăng bài";}?></a>
            </li>

            <li class="nav-item" role="presentation">
                <a class="nav-link" id="pills-contact-tab" data-toggle="pill" href="#pills-contact" role="tab" aria-controls="pills-contact" aria-selected="false">Đăng ảnh</a>
            </li>

        </ul>
    </div>
    </div>

    <!----------------------------------------------------SỬA BÀI VIẾT--------------------------------------->

    <?php if (isset($_GET['edit'])) {?>
        <?php 
        mysqli_set_charset($conn,'UTF8');
        $post_id = $_GET['edit'];
        $select_post = "SELECT * FROM post WHERE post_id = '$post_id'"; 
        $run_post = mysqli_query($conn,$select_post);
        $row_post = mysqli_fetch_array($run_post);
        $post_content = $row_post['post_content'];
        $post_name = $row_post['post_name'];
        $post_type = $row_post['post_type'];
        
        ?>

        


    <div class="tabs mt-2">
        <div class="container mt-2 mb-5">
            <div class="tab-content" id="pills-tabContent">
                <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
            
            <?php 
            if ($post_type == 2) {
            ?> 

            <h3 style="text-align: center;">Sửa Bài Viết</h3>
            <?php 
            if (!empty($statusMsg)) {?>
                <p class="stmsg"><?php echo $statusMsg; ?></p>
            <?php } ?>
                <!-------------------------------------------------FORM EDIT IMG------------------------------>
                <form class="upload_img" action="" method="post" enctype="multipart/form-data">
                    <input style="" placeholder="Tựa Bài Viết" class="text" type="text" name="post_title" value="<?php echo($post_name); ?>">
                    <br>
                    Chọn ảnh muốn đăng:
                    <input type="file" name="files[]" multiple >
                    <input type="hidden" name="post_user_id" value="<?php echo($user_id); ?>">
                    <input type="hidden" name="post_id" value="<?php echo($post_id); ?>">
                    <input type="submit" name="submit-edit-img" value="Xác nhận">
                
                    <br>    
                    <br>
                    
                    <div id="display-img">

                    
                    </div>


                </form>

                <!----------------------------------------POP UP ARE YOU SURE----------------------------------->

                <form class="modal fade" id="are_you_sure" style="color: black;" method="POST">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header text-center">
                        <button type="button" class="close" data-dismiss="modal" aria-lable="close">&times;</button>
                      </div>
                      <div class="modal-body mx-3">
                          <label>Bạn có chắc là muốn tiếp tục không?</label>
                          <input type="hidden" name="post_img_id" id="post_img_id">
                        </div>

                      <div class="modal-footer d-flex justify-content-center">
                        <button class="btn btn-primary" type="submit" name="submit2">Xác nhận</button>
                      </div>

                    </div>
                  </div>
                </form>
                        
               <!-----------------------------------END OF POP UP ARE YOU SURE--------------------------------->         
                

                <!-----------------------------------------END FORM EDIT IMG----------------------->
            
            <?php    
            }
            else{

                edit_post();

        
            ?>


            <h3 style="text-align: center;">Sửa Bài Viết</h3>
            <?php 
            if (!empty($statusMsg)) {?>
                <p class="stmsg"><?php echo $statusMsg; ?></p>


        <?php } ?>
        <form method="post" enctype="multipart/form-data">
        
        <br>
            <input type="hidden" name="post_id" value="<?php echo($post_id); ?>">
            <input type="hidden" name="post_user_id" value="<?php echo ($_SESSION['userid']); ?>">
            <input style="" placeholder="Tựa Bài Viết" class="text" type="text" name="post_title" value="<?php echo($post_name); ?>">

           
            <select name="post_tag" class="tol" disabled>
                <?php 
                mysqli_set_charset($conn,'UTF8');
                    $select_tag = "SELECT * FROM post_categories";
                        $run_tag = mysqli_query($conn,$select_tag);
                       
                        while ($row_tag = mysqli_fetch_array($run_tag)) {
                            $tag_id = $row_tag['post_type'];
                            $tag_name = $row_tag['post_cat_name'];

                            if ($tag_id != 2 && $tag_id != 3) {
                                if ($tag_id == $post_type) {
                                    echo "<option value='$tag_id' selected>$tag_name</option>";
                                }else{
                                    echo "
                                        <option value='$tag_id'>$tag_name</option>
                                    ";
                                }
                            }
                        }
                ?>
            </select>
             <input type="checkbox" class="allergies" id="allergies">
             <?php if ($post_type == 3) {
                echo '<label style="color: white;" class="ml-3">Kết thúc:</label> <input class="ml-3" type="datetime-local" name="exp_date_2">';
            } ?>
            <br>
            <textarea name="editor" id="content" class="form-control ckeditor">
                <?php echo "$post_content"; ?>
            </textarea>
            <input class="btn sub" type="submit" name="submit" value="Xác nhận">
        </form>
    <?php } ?>
                </div>
              
        <div class="tab-pane fade" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab">
            
        <form class="upload_img" action="" method="post" enctype="multipart/form-data">
            <input style="" placeholder="Tựa Bài Viết" class="text" type="text" name="post_title">
            <br>
            Chọn ảnh muốn đăng:
            <input type="file" name="files[]" multiple >
            <input type="hidden" name="post_user_id" value="<?php echo($user_id); ?>">
            <input type="submit" name="submit-img" value="Thêm">
        </form>

        <?php upload_img(); ?>

        </div>

            </div>
        </div>
    </div>




        <script>
             CKEDITOR.replace( 'content', {
              height: 300,
              filebrowserUploadUrl: "process/upload_CKEDITOR.php"
             });

            </script>

      <?php  }

      /*-------------------------------------------------------ĐĂNG BÀI VIẾT--------------------------------*/

      else{?>

    
    <?php include 'process/upload_process.php'; ?>
    
    <div class="tabs mt-2">
        <div class="container mt-2 mb-5">
            <div class="tab-content" id="pills-tabContent">
                <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
    	<h3 style="text-align: center;"><?php if (isset($_GET['event'])) {
            echo "Thêm sự kiện";
        }else {echo "Đăng Bài Viết";}?></h3>
    	<?php 
    		if (!empty($statusMsg)) {?>
    			<p class="stmsg"><?php echo $statusMsg; ?></p>


    	<?php } ?>
    	<form method="post" enctype="multipart/form-data">
    	
    	
    	
    		<input type="hidden" name="post_user_id" value="<?php echo ($_SESSION['userid']); ?>">

    		<div class="up-top">
                
                <input style="" placeholder="<?php ?>Tựa Bài Viết" class="text" type="text" name="post_title">

                <?php
                    if (isset($_GET['event'])) {
                         echo '<label style="color: white;" class="ml-3">Kết thúc:</label> <input class="ml-3" type="datetime-local" name="exp_date">';
                     }else{
                        echo '
                <select name="post_tag">';
                ?>
                    <?php
                        mysqli_set_charset($conn,'UTF8');
                        $select_tag = "SELECT * FROM post_categories";
                        $run_tag = mysqli_query($conn,$select_tag);
                        
                        while ($row_tag = mysqli_fetch_array($run_tag)) {
                            $tag_id = $row_tag['post_type'];
                            $tag_name = $row_tag['post_cat_name'];

                            if ($tag_id != 2 && $tag_id!= 3) {

                            echo "
                                <option value='$tag_id'>$tag_name</option>
                            ";
                            }
                        }

                    ?>
                <?php
                echo '     
                </select>';
                }
                ?>
            </div>

    		<br>
    		<textarea name="content" id="content" class="form-control ckeditor"></textarea>
    		
    		</textarea>
    		<input class="btn sub" type="submit" name="<?php if (isset($_GET['event'])) { echo'submit-event';} else {echo 'submit';}?>" value="Xác nhận">
    	

        </form>
                </div>


        <!-------------------------------------------------ĐĂNG ẢNH--------------------------------------------->
              
    <div class="tab-pane fade" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab">
        
        <h3 style="text-align: center;"><?php echo "Đăng Ảnh"; ?></h3>

        <form class="upload_img" action="" method="post" enctype="multipart/form-data">

            <input style="" placeholder="Tựa Bài Viết" class="text" type="text" name="post_title">
            <br>
            Chọn ảnh muốn đăng:
            <input type="file" name="files[]" multiple >
            <input type="hidden" name="post_user_id" value="<?php echo($user_id); ?>">
            <input type="submit" name="submit-img" value="Thêm">
        </form>

        <?php upload_img(); ?>

    </div>

            </div>
        </div>
    </div>

    



            <script>
             CKEDITOR.replace( 'content', {
              height: 300,
              filebrowserUploadUrl: "process/upload_CKEDITOR.php"
             });

            </script>



    <!-- <script>
      $('#summernote').summernote({
		toolbar: [
			['basic', ['style', 'fontname', 'fontsize']],
			['style', ['bold', 'italic', 'underline', 'clear']],
			['font', ['strikethrough', 'superscript', 'subscript']],
			['fontsize', ['fontsize']],
			['color', ['forecolor', 'backcolor']],
			['block', ['ul', 'ol', 'paragraph']],
			['media', ['link', 'picture', 'video', 'table', 'hr']],
			['height', ['height', 'codeview', 'fullscreen', 'undo', 'redo']]
		],
        tabsize: 2,
        height: 500
      });
    </script> -->
<?php }?>
  </body>

  <script>
      $(document).ready(function() {
          $('.tol').attr('disabled', 'disabled');

          var $checkBox = $('.allergies');

          $checkBox.on('change', function(e) {
            //get the previous element to us, which is the select
            var $select = $(this).prev();
            
            if (this.checked) {
              $select.removeAttr('disabled');
            } else {
              $select.attr('disabled', 'disabled');
            }
          });

          function load_edit_img(){
                $.ajax({
                 url:"process/load_edit_img.php",
                 data: {post_id : <?php echo $_GET['edit']; ?>},
                 method:"POST",
                 success:function(data)
                 {
                  $('#display-img').html(data);

                 }
                })
               }

        load_edit_img();

        $(document).on('click', '.delete_img', function(){
                var post_id = $(this).attr("id");
                $('#post_img_id').val(post_id);
                $('#are_you_sure').modal('show');
               });       

        });

        $('#are_you_sure').on('submit', function(event){
                event.preventDefault();
                var form_data = $(this).serialize();
                $.ajax({
                 url:"process/edit_img_delete.php",
                 method:"POST",
                 data:form_data,
                 success:function()
                 {
                  
                  $('#are_you_sure').modal('hide');
                  function load_edit_img(){
                    $.ajax({
                     url:"process/load_edit_img.php",
                     data: {post_id : <?php echo $_GET['edit']; ?>},
                     method:"POST",
                     success:function(data)
                     {
                      $('#display-img').html(data);

                     }
                    })
                   }
                  load_edit_img();
                  
                
                 }
                })
        });

  </script>
</html>