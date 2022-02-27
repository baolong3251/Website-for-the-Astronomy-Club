<?php 
  require 'connect.php';
  session_start();
  include ('functions.php');
  // update_user_point();
  update_user_rank();
  auto_del();
  
  $query = "SELECT * FROM users ORDER BY ID";  
  $result = mysqli_query($conn,$query);

?>

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
     <?php include ('css/style-main.css'); ?>
     <?php include ('css/style-admin.css') ?>
        
  </style>
</head>
<body>

    <div class="top-content container">
      <div class="top">
        <a class="mr-3" href="index.php">Trang chủ</a>
        <a class="mr-3" href="upload.php?event">Thêm sự kiện</a>
        <a href="chart.php">Thống kê</a>
      </div>

      
      <div class="tab-nav">
                <ul class="nav nav-pills mb-3 mt-3" id="pills-tab" role="tablist">
                  <li class="nav-item" role="presentation">
                    <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true">Tài Khoản</a>
                  </li>
                  <li class="nav-item" role="presentation">
                    <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="false">Bài Đăng</a>
                  </li>
                  <li class="nav-item" role="presentation">
                    <a class="nav-link" id="pills-apply-tab" data-toggle="pill" href="#pills-apply" role="tab" aria-controls="pills-apply" aria-selected="false">Bài chờ duyệt</a>
                  </li>
                  <li class="nav-item" role="presentation">
                    <a class="nav-link" id="pills-report-tab" data-toggle="pill" href="#pills-report" role="tab" aria-controls="pills-report" aria-selected="false">Bài bị báo cáo</a>
                  </li>
                  <li class="nav-item" role="presentation">
                    <a class="nav-link" id="pills-cat-tab" data-toggle="pill" href="#pills-cat" role="tab" aria-controls="pills-cat" aria-selected="false">Chủ đề</a>
                  </li>
                  <li class="nav-item" role="presentation">
                    <a class="nav-link" id="pills-event-tab" data-toggle="pill" href="#pills-event" role="tab" aria-controls="pills-event" aria-selected="false">Sự kiện</a>
                  </li>
                  
                </ul>
      </div>
    </div>  
  
    <div class="tabs mt-2">
        <div  class="container">
          <div class="tab-content" id="pills-tabContent">

        <!-----------------------------------------------USER---------------------------------------------->    
            <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
              <div class="container">

          <form class="d-flex mb-3">
            <input class="form-control me-2 mr-3" type="search" id="search_text" placeholder="Tìm kiếm" aria-label="Search">
            
          </form>
            
            
          <table class="table table-striped table-dark">
              <thead class="thead-dark">
                <tr>
                  <th scope="col">Hạng</th>
                  <th scope="col">Tên</th>
                  <th scope="col">Số bài đã đăng</th>
                  <th scope="col">Điểm</th>
                  <th scope="col">Xóa</th>
                </tr>
              </thead>
              <tbody style="" id="display_user">
          
              </tbody>
          </table>


        <!----------------------------POP UP USER POST------------------------------------>
            
            <form class="modal fade" id="popup_user" method="POST">
              <div class="modal-dialog">
                <div class="modal-content">
                  
                  <div class="modal-header text-center">
                    <h3 class="modal-title dark-grey-text font-weight-bold">Danh sách bài viết</h3>
                    <button type="button" class="close" data-dismiss="modal" aria-lable="close">&times;</button>
                  </div>

                  <div class="modal-body mx-4" style="height: 400px; overflow-y: scroll; overflow-x: hidden; ">
                    <div class="md-form">
                        
                        <ul class="list-post" id="display_list">
                          
                        </ul>

                    </div>

                  </div>

                  <div class="modal-footer mx-4">

                    
                  
                  </div>  
                </div>
              </div> 
            </form>



        <!---------------------------------END POP UP USER POST--------------------------->  


        

        <!------------------------------------FORM ARE YOU SURE???---------------------------->
          <form method="POST" id="popup" style="text-align: center; border: 3px solid #A0DAA9; border-radius: 10px; background: #EFE1CE;">
            <input type="hidden" name="comment_id_2" id="comment_id_2">
            <p style="color: black;"><b>Bạn có chắc là muốn tiếp tục không?</b></p>
            <button class="btn" type="submit" name="submit_2" id="submit_2" value="submit_2">Có</button>
            <button class="btn" type="button" onclick="popupToggle();">Không</button>
          </form>


          
          <!---------------------------------END FORM ARE YOU SURE???------------------------->


  <!--------------------------------------------SCRIPT POPUP---------------------------------------------->
            <script>
            function popupToggle(){
                const popup = document.getElementById('popup');
                popup.classList.toggle('active')
              }

            function popupToggle2(){
                const popup = document.getElementById('admin_post_delete');
                popup.classList.toggle('active')
            }

            function popupToggle3(){
                const popup = document.getElementById('admin_cat_delete');
                popup.classList.toggle('active')
            }
            function popupToggle4(){
                const popup = document.getElementById('admin_event_delete');
                popup.classList.toggle('active')
            }
            </script>
  <!------------------------------------------END SCRIPT POPUP---------------------------------------------->

        </div>
      </div>

      <!--------------------------------------------END USER------------------------------------------------->

      <!--------------------------------------------POST---------------------------------------------------->

      <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
        <div class="container">

          <form class="d-flex mb-3">
            <input class="form-control me-2 mr-3" type="search" id="search_text_post" placeholder="Tìm kiếm" aria-label="Search">
            
          </form>

          <table class="table table-striped table-dark">
            <thead class="thead-dark">
              <tr>
                <th scope="col">ID</th>
                <th scope="col">Tên các bài đã đăng</th>
                <th scope="col">Lượt xem</th>
                <th scope="col">Thích</th>
                <th scope="col">Không thích</th>
                <th scope="col">Xóa</th>
              </tr>
            </thead>
            <tbody style="" id="display_admin_post">
                
            </tbody>
          </table>

      <!-------------------------------------------FORM ARE YOU SURE???------------------------------------------->
          
        <form method="POST" id="admin_post_delete" style="text-align: center; border: 3px solid #A0DAA9; border-radius: 10px; background: #EFE1CE;">
            <input type="hidden" name="post_id_delete" id="post_id_delete">
            <p style="color: black;"><b>Bạn có chắc là muốn tiếp tục không?</b></p>
            <button class="btn" type="submit" name="submit_2" id="submit_2" value="submit_2">Có</button>
            <button class="btn" type="button" onclick="popupToggle2();">Không</button>
          </form>

      <!----------------------------------------END FORM ARE YOU SURE???------------------------------------------>
          </div>
        </div>

        <!------------------------------------------------END POST------------------------------------------------>

        <!--------------------------------------------APPLY POST---------------------------------------------------->

      <div class="tab-pane fade" id="pills-apply" role="tabpanel" aria-labelledby="pills-apply-tab">
        <div class="container">

          <form class="d-flex mb-3">
            <input class="form-control me-2 mr-3" type="search" id="search_apply" placeholder="Tìm kiếm" aria-label="Search">
            
          </form>

          <table class="table table-striped table-dark">
            <thead class="thead-dark">
              <tr>
                <th scope="col">Tên bài</th>
                <th scope="col">Tùy chọn</th>
              </tr>
            </thead>
            <tbody style="" id="display_apply_post">
                
            </tbody>
          </table>

      
          </div>
        </div>

        <!------------------------------------------------END APPLY POST------------------------------------------------>

        <!-------------------------------------------------REPORT---------------------------------------------------->

      <div class="tab-pane fade" id="pills-report" role="tabpanel" aria-labelledby="pills-report-tab">
        <div class="container">

          <form class="d-flex mb-3">
            <input class="form-control me-2 mr-3" type="search" id="search_report" placeholder="Tìm kiếm" aria-label="Search">
            
          </form>

          <table class="table table-striped table-dark">
            <thead class="thead-dark">
              <tr>
                <th scope="col">Tên bài</th>
                <th scope="col">Số lượt báo cáo</th>
                <th scope="col">Tùy chọn</th>
              </tr>
            </thead>
            <tbody style="" id="display_report_post">
                
            </tbody>
          </table>

      
          </div>
        </div>

        <!------------------------------------------------END REPORT------------------------------------------------>

        
        <!-------------------------------------------------CATEGORIES------------------------------------------->

        <div class="tab-pane fade" id="pills-cat" role="tabpanel" aria-labelledby="pills-cat-tab">
          <div class="container">

          <form class="d-flex mb-3">
            <input class="form-control me-2 mr-3" type="search" id="search_cat" placeholder="Tìm kiếm" aria-label="Search">
            
          </form>

          <div class="action" onclick="">
              <span>+</span>
          </div>

          <table class="table table-striped table-dark">
            <thead class="thead-dark">
              <tr>
                <th scope="col">Tên chủ đề</th>
                <th scope="col">Tùy chọn</th>
              </tr>
            </thead>
            <tbody style="" id="display_cat">
                
            </tbody>
          </table>

          <!-------------------------------------------FORM ARE YOU SURE???------------------------------------------->
          
            <form method="POST" class="popup" id="admin_cat_delete" style="text-align: center; border: 3px solid #A0DAA9; border-radius: 10px; background: #EFE1CE;">
                <input type="hidden" name="cat_id_delete" id="cat_id_delete">
                <p style="color: black;"><b>Bạn có chắc là muốn tiếp tục không?</b></p>
                <button class="btn" type="submit" name="submit_3" id="submit_3" value="submit_3">Có</button>
                <button class="btn" type="button" onclick="popupToggle3();">Không</button>
            </form>

          <!----------------------------------------END FORM ARE YOU SURE???------------------------------------------>
      
          <!----------------------------POP UP ADD CATEGORIES------------------------------------>
            
            <form class="modal fade" id="addcat" method="POST">
              <div class="modal-dialog">
                <div class="modal-content">
                  
                  <div class="modal-header text-center">
                    <h3 class="modal-title dark-grey-text font-weight-bold">Thêm chủ đề</h3>
                    <button type="button" class="close" data-dismiss="modal" aria-lable="close">&times;</button>
                  </div>

                  <div class="modal-body mx-4">
                    <div class="md-form">
                        
                        <input type="text" name="cat_name" class="form-control validate" placeholder="Nhập tên chủ đề">

                    </div>

                  </div>

                  <div class="modal-footer mx-4">

                    <div class="text-center mb-3">
                        <button type="submit" name="submit" class="btn btn-primary btn-block z-depth-1a">Thêm</button>
                    </div>
                  
                  </div>  
                </div>
              </div> 
            </form>



        <!---------------------------------END POP UP ADD CATEGORIES--------------------------->



          </div>
        </div>
        
        <!------------------------------------------------END CATEGORIES---------------------------------------------->


        <!-------------------------------------------------EVENT------------------------------------------->

        <div class="tab-pane fade" id="pills-event" role="tabpanel" aria-labelledby="pills-event-tab">
          <div class="container">

          <form class="d-flex mb-3">
            <input class="form-control me-2 mr-3" type="search" id="search_event" placeholder="Tìm kiếm" aria-label="Search">
            
          </form>

          <table class="table table-striped table-dark">
            <thead class="thead-dark">
              <tr>
                <th scope="col">Tên các bài đã đăng</th>
                <th scope="col">Lượt xem</th>
                <th scope="col">Editor  </th>
              </tr>
            </thead>
            <tbody style="" id="display_event">
                
            </tbody>
          </table>

          <!-------------------------------------------FORM ARE YOU SURE???------------------------------------------->
          
            <form method="POST" class="popup" id="admin_event_delete" style="text-align: center; border: 3px solid #A0DAA9; border-radius: 10px; background: #EFE1CE;">
                <input type="hidden" name="event_id_delete" id="event_id_delete">
                <p style="color: black;"><b>Bạn có chắc là muốn tiếp tục không?</b></p>
                <button class="btn" type="submit" name="submit_4" id="submit_4" value="submit_4">Có</button>
                <button class="btn" type="button" onclick="popupToggle4();">Không</button>
            </form>

          <!----------------------------------------END FORM ARE YOU SURE???------------------------------------------>



          </div>
        </div>
        
        <!------------------------------------------------END EVENT---------------------------------------------->
            
    </div>
  </div>
</div>


      
  
<!-- //--------------------------------SHOWING STAR ON SCREEN----------------------------------// -->
  <script> 
    
  </script>

  <!-- //----------------------------END SHOWING STAR ON SCREEN----------------------------------// -->

  <!-- <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script> -->
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js"></script>

  <!-- //-----------------------------------NEW TAB FUNCTION----------------------------------// -->
  <script> 
      // function NewTab() {
      //       window.open(
      //         "https://www.geeksforgeeks.org", "_blank");
      //   }
  </script>

  <!-- //---------------------------------END NEW TAB FUNCTION----------------------------------// -->

<!-- //--------------------------------------SOME AJAX SCRIPT----------------------------------// -->

  <script>

    $(document).ready(function(){

      //------------------------------------------//

        $('#popup').on('submit', function(event){
            event.preventDefault();
            var form_data = $(this).serialize();
            $.ajax({
             url:"process/admin_delete.php",
             method:"POST",
             data:form_data,
             success:function()
             {
              
          
              popupToggle();
              load_data();
            
             }
            })
           });

        //------------------------------------------//

        $('#admin_post_delete').on('submit', function(event){
            event.preventDefault();
            var form_data = $(this).serialize();
            $.ajax({
             url:"process/admin_delete_post.php",
             method:"POST",
             data:form_data,
             success:function()
             {
              
              update_num_post();
              load_data_post();
              popupToggle2();
              load_data();
            
             }
            })
           });
        
        //------------------------------------------//

        //------------------------------------------//

        $('#admin_cat_delete').on('submit', function(event){
            event.preventDefault();
            var form_data = $(this).serialize();
            $.ajax({
             url:"process/admin_delete_cat.php",
             method:"POST",
             data:form_data,
             success:function()
             {
              
              load_data_cat();
              popupToggle3();
            
             }
            })
           });
        
        //------------------------------------------//

        //------------------------------------------//

        $('#addcat').on('submit', function(event){
            event.preventDefault();
            var form_data = $(this).serialize();
            $.ajax({
             url:"process/admin_add_cat.php",
             method:"POST",
             data:form_data,
             success:function()
             {
              
              load_data_cat();
              $('#addcat').modal('hide');
            
             }
            })
           });
        
        //------------------------------------------//

        //------------------------------------------//

        $('#admin_event_delete').on('submit', function(event){
            event.preventDefault();
            var form_data = $(this).serialize();
            $.ajax({
             url:"process/admin_delete_event.php",
             method:"POST",
             data:form_data,
             success:function()
             {
              update_num_post();
              load_data_event();
              popupToggle4();
            
             }
            })
           });
        
        //------------------------------------------//

            // function load_admin_user()
            //    {
            //     $.ajax({
            //      url:"process/load_admin_user.php",
            //      method:"POST",
            //      success:function(data)
            //      {
            //       $('#display_user').html(data);
                  
            //      }
            //     })
            //    }
            // load_admin_user();

            load_data();

               function load_data(query)
               {
                $.ajax({
                 url:"process/load_admin_user.php",
                 method:"POST",
                 data:{query:query},
                 success:function(data)
                 {
                  $('#display_user').html(data);
                 }
                });
               }
               $('#search_text').keyup(function(){
                var search = $(this).val();
                if(search != '')
                {
                 load_data(search);
                }
                else
                {
                 load_data();
                }
               });

        //------------------------------------------//

        //------------------------------------------//
          // function load_admin_post()
          //      {
          //       $.ajax({
          //        url:"process/load_admin_post.php",
          //        method:"POST",
          //        success:function(data)
          //        {
          //         $('#display_admin_post').html(data);
                  
          //        }
          //       })
          //      }
          //   load_admin_post();

            load_data_post();

               function load_data_post(query)
               {
                $.ajax({
                 url:"process/load_admin_post.php",
                 method:"POST",
                 data:{query:query},
                 success:function(data)
                 {
                  $('#display_admin_post').html(data);
                 }
                });
               }
               $('#search_text_post').keyup(function(){
                var search = $(this).val();
                if(search != '')
                {
                 load_data_post(search);
                }
                else
                {
                 load_data_post();
                }
               });

               function load_data_apply_post(query)
               {
                $.ajax({
                 url:"process/load_admin_apply_post.php",
                 method:"POST",
                 data:{query:query},
                 success:function(data)
                 {
                  $('#display_apply_post').html(data);
                 }
                });
               }
               $('#search_apply').keyup(function(){
                var search = $(this).val();
                if(search != '')
                {
                 load_data_apply_post(search);
                }
                else
                {
                 load_data_apply_post();
                }
               });
               load_data_apply_post();

               function load_data_report_post(query)
               {
                $.ajax({
                 url:"process/load_admin_report_post.php",
                 method:"POST",
                 data:{query:query},
                 success:function(data)
                 {
                  $('#display_report_post').html(data);
                 }
                });
               }
               $('#search_report').keyup(function(){
                var search = $(this).val();
                if(search != '')
                {
                 load_data_report_post(search);
                }
                else
                {
                 load_data_report_post();
                }
               });
               load_data_report_post();

               function load_data_cat(query)
               {
                $.ajax({
                 url:"process/load_admin_cat.php",
                 method:"POST",
                 data:{query:query},
                 success:function(data)
                 {
                  $('#display_cat').html(data);
                 }
                });
               }
               $('#search_cat').keyup(function(){
                var search = $(this).val();
                if(search != '')
                {
                 load_data_cat(search);
                }
                else
                {
                 load_data_cat();
                }
               });

               load_data_cat();

               function load_data_event(query)
               {
                $.ajax({
                 url:"process/load_admin_event.php",
                 method:"POST",
                 data:{query:query},
                 success:function(data)
                 {
                  $('#display_event').html(data);
                 }
                });
               }
               $('#search_event').keyup(function(){
                var search = $(this).val();
                if(search != '')
                {
                 load_data_event(search);
                }
                else
                {
                 load_data_event();
                }
               });
               load_data_event();

        //------------------------------------------//       
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
        //------------------------------------------//       
        //------------------------------------------//

          $(document).on('click', '.delete', function(){
                var comment_id = $(this).attr("id");
                $('#comment_id_2').val(comment_id);
                popupToggle();
              });

        //------------------------------------------//

        //------------------------------------------//

          $(document).on('click', '.delete2', function(){
                var post_id = $(this).attr("id");
                $('#post_id_delete').val(post_id);
                popupToggle2();
              });

        //------------------------------------------//

        //------------------------------------------//

          $(document).on('click', '.delete3', function(){
                var cat_id = $(this).attr("id");
                $('#cat_id_delete').val(cat_id);
                popupToggle3();
              });

        //------------------------------------------//

        //------------------------------------------//

          $(document).on('click', '.action', function(){
                $('#addcat').modal('show');
              });

        //------------------------------------------//

        //------------------------------------------//

          $(document).on('click', '.delete4', function(){
                var event_id = $(this).attr("id");
                $('#event_id_delete').val(event_id);
                popupToggle4();
              });

        //------------------------------------------//

        //------------------------------------------//

          $(document).on('click', '.deapply', function(){
                var post_id_tmp = $(this).attr("id");
                var post_id = post_id_tmp.slice(3);
                var search = $('#search_apply').val();
                $.ajax({
                 url:"process/admin_delete_post.php",
                 method:"POST",
                 data: {post_id_delete: post_id},
                 success:function()
                 {
                  update_num_post();
                  load_data_apply_post(search);
                  load_data();
                
                 }
                })
                
              });

        //------------------------------------------//

        //------------------------------------------//

          $(document).on('click', '.delpost', function(){
                var post_id_tmp = $(this).attr("id");
                var post_id = post_id_tmp.slice(3);
                var search = $('#search_report').val();
                $.ajax({
                 url:"process/admin_delete_post.php",
                 method:"POST",
                 data: {post_id_delete: post_id},
                 success:function()
                 {
                  update_num_post();
                  load_data_report_post(search);
                  load_data();
                
                 }
                })
                
              });

        //------------------------------------------//

        //------------------------------------------//

          $(document).on('click', '.unreport', function(){
                var post_id_tmp = $(this).attr("id");
                var post_id = post_id_tmp.slice(3);
                var search = $('#search_report').val();
                $.ajax({
                 url:"process/admin_apply_post.php",
                 method:"POST",
                 data: {post_id: post_id},
                 success:function()
                 {
                  
                  load_data_report_post(search);
                  load_data_post();
                
                 }
                })
                
              });

        //------------------------------------------//s

        //------------------------------------------//

          $(document).on('click', '.apply', function(){
                var post_id_tmp = $(this).attr("id");
                var post_id = post_id_tmp.slice(2);
                var search = $('#search_apply').val();
                $.ajax({
                 url:"process/admin_apply_post.php",
                 method:"POST",
                 data: {post_id: post_id},
                 success:function()
                 {
                  
                  load_data_apply_post(search);
                  load_data_post();
                
                 }
                })
                
              });

        //------------------------------------------//

        //------------------------------------------//

          $(document).on('click', '.user_post', function(){
                var user_id = $(this).attr("id");
                $('#popup_user').modal('show');
                $.ajax({
                 url:"process/load_admin_user_post.php",  /// CUSTOMIZE TỤI NÓ LẠI
                 method:"POST",
                 data:{user_id2: user_id},
                 success:function(data)
                 {
                  $('#display_list').html(data);
                 }
                });
                
              });

        //------------------------------------------//



  });
  </script>
  
  <!-- //---------------------------------END SOME AJAX SCRIPT----------------------------------// -->

    

</body>
</html>