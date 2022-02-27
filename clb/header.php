<!DOCTYPE html>
<html>
<head>
  <title></title>
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
  
  <script defer src="https://use.fontawesome.com/releases/v5.11.1/js/all.js">
          




  </script>
  <style>
      <?php include ('css/style-header.css'); ?>    
  </style>
</head>
<body>

  <!------------------------------------FORM ĐĂNG KÝ-------------------------->
  <form class="modal fade" id="signupPage" method="POST">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header text-center">
          <h4 class="modal-title text-center font-weight-bold">Đăng Ký</h4>
          <button type="button" class="close" id="signup-close" data-dismiss="modal" aria-lable="close">&times;</button>
        </div>
        <div class="modal-body mx-3">
          <div class="md-form mb-5">
            <i class="fas fa-user prefix grey-text"></i>
            <input type="text" name="user" class="form-control validate">
            <label>Tài Khoản</label>
          </div>

          <div class="md-form mb-5">
            <i class="fas fa-lock prefix grey-text"></i>
            <input type="password" name="password" class="form-control validate">
            <label>Mật Khẩu</label>
          </div>


          <div class="md-form mb-5">
            <i class="fas fa-lock prefix grey-text"></i>
            <input type="password" name="re_password" class="form-control validate">
            <label>Nhập Lại Mật Khẩu</label>
          </div>

          <div  id="signuperror">

          </div>
        </div>

        <div class="modal-footer d-flex justify-content-center">
          <button class="btn btn-primary" type="submit" name="submit">Đăng ký</button>
        </div>
      </div>
    </div>
  </form>
  
<!-------------------------------------------END FORM ĐĂNG KÝ----------------------------->

<!-------------------------------------------FORM ĐĂNG NHẬP------------------------------->

<form class="modal fade" id="signinPage" method="POST" action="process/signin.php">
  <div class="modal-dialog">
    <div class="modal-content">
      
      <div class="modal-header text-center">
        <h3 class="modal-title dark-grey-text font-weight-bold">Đăng Nhập</h3>
        <button type="button" class="close" data-dismiss="modal" aria-lable="close">&times;</button>
      </div>

      <div class="modal-body mx-4">
        <div class="md-form">
          <i class="fas fa-user prefix grey-text"></i>
          <input type="text" name="user_signin" class="form-control validate">
          <label data-error="wrong" data-success="right">Tài Khoản</label>
        </div>

        <div class="md-form">
          <i class="fas fa-lock prefix grey-text"></i>
          <input type="password" name="password_signin" class="form-control validate">
          <label data-error="wrong" data-success="right">Mật Khẩu</label>
        </div>

        <div class="text-center mb-3">
          <button type="submit" name="submit" class="btn btn-primary btn-block z-depth-1a">Đăng Nhập</button>
        </div>

        <div id="signinerror">
          
        </div>

      </div>
    </div>
    </div> 
  </form>
  
  <!---------------------------------------------------END FORM ĐĂNG NHẬP------------------------------------->

  <!---------------------------------------------------ACCOUNT------------------------------------------------>
  
  
  
<!-------------------------------------------END ACCOUNT----------------------------->

  <!-----------------------------------------POPUP Script---------------------------->

  <script>
    function popupToggle3(){
      const popup = document.getElementById('accountPopup');
      popup.classList.toggle('active')
    }

  </script>
  <!-----------------------------------------END POPUP Script------------------------>

  <!-- <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script> -->
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js"></script>

  <!---------------------------------------------------NAV BAR ----------------------------------------------->

    <nav class="navbar navbar-expand-lg navbar-light fixed-top">
    <div class="container">
      <a class="navbar-brand" href="#">CLB Thiên Văn</a> <button aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation" class="navbar-toggler" data-target="#navbarSupportedContent" data-toggle="collapse" type="button"><span class="navbar-toggler-icon"></span></button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item active">
            <a class="nav-link" href="index.php">Trang chủ</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="rank.php">Xếp hạng</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="content.php">Bài viết</a>
          </li>
          <li class="nav-item repon">
            <a class="nav-link" href="content.php?event">Event</a>
          </li>
          <li class="nav-item repon">
            <a class="nav-link" href="" data-toggle="modal" data-target="#signupPage">Đăng ký</a>
          </li>
          <li class="nav-item repon">
            <a class="nav-link" href="zodiac_sign">Tử vi</a>
          </li>
          <?php if (isset($_SESSION['useruid'])) {
                $admin = $_SESSION['useruid'];
            if ($admin == 'admin') {
            echo '<li class="nav-item">
                    <a class="nav-link" href="admin.php">quản trị viên</a>
                  </li>';
                 } 
          } ?>
          <li class="nav-item">
            <a class="nav-link" <?php if (isset($_SESSION['userid'])) { echo 'href="account.php"';} else{
                echo 'onclick="pop_up_fail();" href="javascript:void(0)"';
            }?>>Tài khoản</a>
          </li>
          <li class="nav-item">
            <?php if (isset($_SESSION['userid'])) {
              echo '<a class="nav-link" href="../clb/process/signout.php">Đăng Xuất</a>';
            }else{
              echo '<a class="nav-link" href="" data-toggle="modal" data-target="#signinPage">Đăng nhập</a>';
            } ?>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <!----------------------------------------------END NAV BAR------------------------------------------------->

  <!------------------------------------------------ SLIDER--------------------------------------------------->

<div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
  <ol class="carousel-indicators">
    <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
    <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
    <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
  </ol>
  <div class="carousel-inner">
    <div class="carousel-item active">
      <!-- <section style="background-image: url('images/1.jpg');  background-repeat: no-repeat;
    background-size: 100% 100%;">
      <div class="carousel-caption d-none d-md-block">
        <h5>First slide label</h5>
        <p>Some representative placeholder content for the first slide.</p>
        <p><a href="#">More Info</a></p>
      </div>
    </section> -->
    <?php if (isset($_SESSION['userid'])) {
      echo '
      <img src="images/46707-1.jpg" class="d-block w-100" alt="...">
      <div class="carousel-caption d-none d-md-block">
        <h5 class="animated bounceInRight" style="animation-delay: 1s;">Chào mừng đến CLB Thiên Văn</h5>
        <p class="animated bounceInRight" style="animation-delay: 2s;">Hãy cùng tìm hiểu hệ mặt trời nếu bạn có hứng thú</p>
        <p class="animated bounceInRight" style="animation-delay: 3s;"><a href="3D-CSS-Solar-System">Xem Thêm</a></p>
      </div>';
    }else{
      echo '<img src="images/4-1.jpg" class="d-block w-100" alt="...">
      <div class="carousel-caption d-none d-md-block">
        <h5 class="animated bounceInRight" style="animation-delay: 1s;">Chào mừng đến CLB Thiên Văn</h5>
        <p class="animated bounceInRight" style="animation-delay: 2s;">Hãy đăng ký làm thành viên bằng cách nhấn vào nút bên dưới nhé</p>
        <p class="animated bounceInRight" style="animation-delay: 3s;"><a href="" data-toggle="modal" data-target="#signupPage">Đăng ký tại đây</a></p>
      </div>';
    }
      ?>
    
    </div>
    <div class="carousel-item">
      <img src="images/2.jpg" class="d-block w-100" alt="...">
      <div class="carousel-caption d-none d-md-block">
        <h5 class="animated slideInDown" style="animation-delay: 1s;">12 Cung hoàng đạo (Zodiac Sign)</h5>
        <p class="animated fadeInUp" style="animation-delay: 2s;">Cùng tìm hiểu về cung hoàng đạo cùng clb nào ^^</p>
        <p class="animated zoomIn" style="animation-delay: 3s;"><a href="zodiac_sign">Cùng tìm hiểu nào</a></p>
      </div>
    </div>
    <div class="carousel-item">
      <img src="images/3.jpg" class="d-block w-100" alt="...">
      <div class="carousel-caption d-none d-md-block">
        <h5 class="animated zoomIn" style="animation-delay: 1s;">SỰ KIỆN</h5>
        <p class="animated fadeInLeft" style="animation-delay: 2s;">Tất cả Sự kiện đã được tổ chức của CLB và tất cả event sắp được tổ chức của CLB, bấm vào ô bên dưới để xem chi tiết nhé</p>
        <p class="animated zoomIn" style="animation-delay: 3s;"><a href="content.php?event">Thông tin chi tiết</a></p>
      </div>
    </div>
  </div>
  <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
</div>

    <!---------------------------------------------- END SLIDER------------------------------------------>



      <script>
        $(document).ready(function(){
               
               $('#signupPage').on('submit', function(event){
                event.preventDefault();
                var form_data = $(this).serialize();
                $.ajax({
                 url:"process/signup.php",
                 method:"POST",
                 data:form_data,
                 dataType:"JSON",
                 success:function(data)
                 {
                  if(data.error != '')
                    {
                     $('#signupPage')[0].reset();
                     $('#signuperror').html(data.error);
                    }
                    if (data.error == '') {
                      pop_up();
                      $("#signup-close").click();
                    }
                 }
                })
               });

               $('#signinPage').on('submit', function(event){
                event.preventDefault();
                var form_data = $(this).serialize();
                $.ajax({
                 url:"process/signin.php",
                 method:"POST",
                 data:form_data,
                 dataType:"JSON",
                 success:function(data)
                 {
                  if(data.error != '')
                    {
                     $('#signinPage')[0].reset();
                     $('#signinerror').html(data.error);
                    }
                    if (data.error == '') {
                      location.reload(true);
                    }
                 }
                })
               });

               function pop_up(){
                swal("Đăng Ký Thành Công", "Hãy nhấn vào Đăng Nhập để trải nghiệm nhé ^^","success");
                }
                
               });
                
                function pop_up_fail(){
                swal("Không Xem Được", "Vui Lòng Đăng Nhập Để Thực Hiện Thao Tác","error");
                }

      </script>

</body>
</html>