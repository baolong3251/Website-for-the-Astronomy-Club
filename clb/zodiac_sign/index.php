<?php 
  session_start();
  require '../connect.php';

  if (isset($_POST['edit-submit'])) {
    if (!empty($_POST['edit-content'])) {
      $edit_content = $_POST['edit-content'];
      $star_id = $_POST['edit-star-id'];
      $update = "UPDATE zodiac_sign SET star_content = '$edit_content' where star_id = '$star_id'";
      $run = mysqli_query($conn,$update);
      mysqli_set_charset($conn,'UTF-8');
      if ($run) {
        echo "<script>alert('Sửa thành công')</script>";
        echo "<script>window.open('index.php','_self')</script>";
      }
    }
  }

?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
	<meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />

  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css">
  
  <link href="https://fonts.googleapis.com/css2?family=Merienda&display=swap" rel="stylesheet">
  
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;700&display=swap" rel="stylesheet">
  
  <!-- <link href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.2/animate.min.css" rel="stylesheet"> -->

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>

  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
  
  <script defer src="https://use.fontawesome.com/releases/v5.11.1/js/all.js"></script>
	<style>
	*{
		margin: 0;
		padding: 0;
	}
	body {
      background: #fff;
      font-family: Helvetica Neue, Helvetica, Arial, sans-serif;
      font-size: 14px;
      display: flex;
      justify-content: center;
      align-items: center;
      min-height: 100vh;
      background: #111;
    }

    .swiper-container {
      width: 100%;
      padding-top: 50px;
      padding-bottom: 200px;
    }

    .swiper-slide {
      background-position: center;
      background-size: cover;
      width: 300px;
      height: 300px;
      background: #000;
      -webkit-box-reflect: below 1px linear-gradient(transparent,transparent,#0006);
    }
    .swiper-slide p{
      -webkit-box-reflect: below 1px linear-gradient(transparent,transparent,#0006);
    }
    .swiper-slide img{
    	width: 300px;
    	height: 300px;
    }
    .md-form img{
      max-width: 400px;
      max-height: 500px;
    }
    .modal-dialog{
      margin-left: 90px;
      /*margin-left: 200px;*/
    }
    .modal-content{
      width: 1200px;
      /*width: 1000px;*/
      height: 600px;
      background: #111;
      color: white;
      border: 1px solid #404040;
    }
    .modal-header{
      border-bottom: 1px solid #404040;
    }
    .modal-content .close{
      color: white;
    }
    .md-form{
      display: flex;
      justify-content: space-between;
    }
    .md-value{
      margin-left: 40px;
    }
    .edit-content{
      background: none;
      color: #fff;
      border: none;
      outline: none;
    }
    .swiper-wrapper a:hover{
      text-decoration-line: none;
    }
    .star-content{
      background: none;
    }
    .form-control:disabled, .form-control[readonly] {
      background: none;
      opacity: 1;
      outline: none;
      color: #fff;
      border: none;
    }
    #filter{
      width: 200px;
    }
    @media only screen and (max-width: 500px) {
      .modal-content{
        width: 100%;
        height: 100%;
      }
      .md-form img{
        max-width: 100%;
        height: auto;
        display: none;
      }
      .modal-dialog{
        margin-left: 8px;
      /*margin-left: 200px;*/
        height: 600px;
      }
      html {
            overflow-y: overlay;
        }
        #filter{
      width: 100px;
    }
    }
	</style>
</head>
<body>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js"></script>
	<script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>

	 <!-- Swiper -->
  <div class="swiper-container">
    <div style="text-align: center;">
      <a href="../index.php" style="margin-right: 10px;">Trang chủ</a>
      <?php if (isset($_SESSION['userid'])) {
        if ($_SESSION['useruid'] == 'admin') { ?>
          <a href="" href="" data-toggle="modal" data-target="#edit">Sửa</a></div>
       <?php } else{ ?>
          <a href="" href="" data-toggle="modal" data-target="#edit"></a></div>
      <?php } 
      } else { ?>
      <a href="" href="" data-toggle="modal" data-target="#edit"></a></div>
    <?php } ?>
    <div class="swiper-wrapper" id="swiper-wrapper">
      
      <?php
        $select = "SELECT * FROM zodiac_sign";
        $run = mysqli_query($conn,$select);
        mysqli_set_charset($conn,'UTF-8');
        while ($row = mysqli_fetch_array($run)) {
          $star_name = $row['star_name'];
          $star_id = $row['star_id'];
          $star_img = $row['star_img'];
          $star_content = $row['star_content'];
          echo "
            <div class='swiper-slide'><a href='' data-toggle='modal' data-target='#s-$star_id'><img src='zodiac_sign/$star_img'><p style='color: white; text-align: center;'>$star_name</p></a></div>

            

          ";
        }

      ?>
      
    </div>
    <!-- Add Pagination -->
    <div class="swiper-pagination"></div>
  </div>

  <!-- Swiper JS -->
  <script src="../package/swiper-bundle.min.js"></script>

  <!-- Initialize Swiper -->
  <script>
    var swiper = new Swiper('.swiper-container', {
      effect: 'coverflow',
      grabCursor: true,
      centeredSlides: true,
      slidesPerView: 'auto',
      coverflowEffect: {
        rotate: 20,
        stretch: 0,
        depth: 100,
        modifier: 1,
        slideShadows: true,
      },
      loop: true,
      autoplay: {
        delay: 2500,
        disableOnInteraction: false,
      },
      // pagination: {
      //   el: '.swiper-pagination',
      // },
    });
  </script>

  <!--------------------------------FORM OF ZODIAC SIGN---------------------------------------->

  <!-------------------------------------  EDIT  ---------------------------------------------->

  <div class="modal fade" id="edit">
    
    <div class="modal-dialog">
      
      <div class="modal-content">
        <form method="POST">

          <div class="modal-header text-center">
            <h4 class="modal-title text-center font-weight-bold">Sửa</h4>
            <select class="form-control ml-2" name="zodiac_sign" id="filter">
              <?php

                $select = "SELECT * FROM zodiac_sign";
                $run = mysqli_query($conn,$select);
                mysqli_set_charset($conn,'UTF-8');
                while ($row = mysqli_fetch_array($run)) {
                  $star_name = $row['star_name'];
                  $star_id = $row['star_id'];
                  echo "
                    <option class='common_selector star' value='$star_id'>$star_name</option>
                  ";
                }
               ?>
            </select>
            <input class="btn btn-primary ml-3" type="submit" value="Lưu" name="edit-submit">
            <button type="button" class="close" data-dismiss="modal" aria-lable="close">&times;</button>
          </div>

          <div class="modal-body mx-3">
            <div class="md-form mb-4" id="show-edit">
                   
            </div>

          </div>
        </form>
      </div>
    </div>
  </div>    

  <!--------------------------------FORM OF ZODIAC SIGN---------------------------------------->

  <?php
        $select = "SELECT * FROM zodiac_sign";
        $run = mysqli_query($conn,$select);
        mysqli_set_charset($conn,'UTF-8');
        while ($row = mysqli_fetch_array($run)) {
          $star_name = $row['star_name'];
          $star_id = $row['star_id'];
          $star_img = $row['star_img'];
          $star_content = $row['star_content'];
          echo "
          <div class='modal fade' id='s-$star_id'>
    
            <div class='modal-dialog'>
              
              <div class='modal-content'>

                <div class='modal-header text-center'>
                  <h4 class='modal-title text-center font-weight-bold'>$star_name</h4>
                  <button type='button' class='close' data-dismiss='modal' aria-lable='close'>&times;</button>
                </div>

                <div class='modal-body mx-3'>
                  <div class='md-form mb-4'>
                      <img src='zodiac_sign/$star_img'>       
                      <div class='md-value'><textarea class='form-control star-content' cols='100' rows='20' disabled>$star_content</textarea></div>     
                  </div>

                </div>

              </div>
            </div>
          </div>

            

          ";
        }

      ?>
  <!-----------------------------------------EDIT IMG---------------------------------------->
    <div class='modal fade' id='edit-img'>
    
      <div class='modal-dialog' style="margin-left: 0px; margin: auto; margin-top: 50px;">
              
        <div class='modal-content' style="width: 500px; height: 200px;">
          <form method="post" enctype="multipart/form-data" id="edit-img-sub">
            <div class='modal-header text-center' id="edit-img-sub">
              <button type='button' class='close' data-dismiss='modal' aria-lable='close'>&times;</button>
            </div>

            <div class='modal-body mx-3'>
              <div class='md-form mb-4'>
                  <input type="hidden" name="img_id" id="img_id">
                  <input type="FILE" name="img_name" id="image">     
              </div>

            </div>

            <div class="modal-footer d-flex justify-content-center" style="border-top: 1px solid #404040;">
              <button class="btn btn-primary" type="submit" name="submit">Đổi</button>
            </div>
          </form>
        </div>
      </div>
    </div>

</body>

<script>
         $(document).ready(function(){

              // function load_swiper_wrapper(){
              //   $.ajax({
              //    url:"process/load_swiper_wrapper.php",
              //    data: {},
              //    method:"POST",
              //    success:function(data)
              //    {
                  
              //     $('#swiper-wrapper').html(data);
                  

              //    }
              //   })
              // } 
              // load_swiper_wrapper();

              function load_edit(){
                $.ajax({
                 url:"process/load_edit.php",
                 data: {star_id2:1},
                 method:"POST",
                 success:function(data)
                 {
                  
                  $('#show-edit').html(data);
                  

                 }
                })
              } 
              load_edit();
              

              $('#filter').change(function() {
                  var star_id = $(this).val();
                  $.ajax({
                 url:"process/load_edit.php",  
                 method:"POST",
                 data:{star_id2: star_id},
                 success:function(data)
                 {
                  $('#show-edit').html(data);
                 }
                });
              });

            });

         $(document).on('click', '.edit-img', function(){
                var star_id = $(this).attr("id");
                $('#img_id').val(star_id);
                $('#edit-img').modal('show');
              });

          $('#edit-img-sub').on('submit', function(event){
                  event.preventDefault();
                  var image_name = $('#image').val();
                if(image_name == '')
                  {
                   alert("Xin chọn ảnh!!");
                   return false;
                  }
                else
                  {
                   var extension = $('#image').val().split('.').pop().toLowerCase();
                if(jQuery.inArray(extension, ['gif','png','jpg','jpeg']) == -1)
                   {
                    alert("File không hợp lệ");
                    $('#image').val('');
                    return false;
                   }
                else
                   {
                    $.ajax({
                     url:"process/update_img.php",
                     method:"POST",
                     data:new FormData(this),
                     contentType:false,
                     processData:false,
                     success:function(data)
                     {
                      alert('Đổi thành công!!');
                      location.reload();
                     }
                    });
                   }
            }

    });
</script>
</html>