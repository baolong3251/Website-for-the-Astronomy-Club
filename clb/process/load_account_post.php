<?php 
  session_start();
  require '../connect.php';
  require '../functions.php';
    $user_id = $_POST['user_id'];
    if (isset($_SESSION['userid'])) {
      $user_id_2 = $_SESSION['userid'];
    }
    mysqli_set_charset($conn,'UTF8');   
    $select_account = "SELECT * FROM post WHERE user_id = '$user_id' ORDER BY post_date DESC";
    $run_account = mysqli_query($conn,$select_account);
    while ($row_account = mysqli_fetch_array($run_account)) {
        
      $post_name = $row_account['post_name'];
      $post_view = $row_account['post_view'];
      $post_like = $row_account['post_like'];
      $post_dislike = $row_account['post_dislike'];
      $post_id = $row_account['post_id'];
      $post_type = $row_account['post_type'];
      $post_content = $row_account['post_content'];
      $post_date = $row_account['post_date'];
      $post_user_id = $row_account['user_id'];
      $post_stat = $row_account['post_stat'];
      $time_ago = time_elapsed_string($post_date);

      $get_post_cat = "SELECT * FROM post_categories where post_type = '$post_type'";
      $run_post_cat = mysqli_query($conn,$get_post_cat);
      $row_post_cat = mysqli_fetch_array($run_post_cat);
      $post_cat_name = $row_post_cat['post_cat_name'];

      $get_user = "SELECT * FROM users WHERE user_id = '$post_user_id'";
      $run_user = mysqli_query($conn,$get_user);
      $row_user = mysqli_fetch_array($run_user);
      $user = $row_user['user_name'];
      $user_pic = $row_user['user_pic'];

      if (isset($_SESSION['userid'])) {
      $insert_vote = "INSERT INTO vote_status (user_id, post_id)
      SELECT * FROM (SELECT '$user_id_2', '$post_id') AS tmp
      WHERE NOT EXISTS (
          SELECT vote_value FROM vote_status WHERE user_id = '$user_id_2' AND post_id= '$post_id'
      ) LIMIT 1";
      $run_i_vote = mysqli_query($conn,$insert_vote);

      $get_vote = "SELECT * FROM vote_status WHERE user_id = '$user_id_2' AND post_id = '$post_id'";
      $run_vote = mysqli_query($conn,$get_vote);
      $row_vote = mysqli_fetch_array($run_vote);
      $vote_value = $row_vote['vote_value'];
      }

      $numComments = 0;

      $get_post_comment = "SELECT post_id FROM comment where post_id = '$post_id'";
      $run_post_comment = mysqli_query($conn,$get_post_comment);
      $numComments = mysqli_num_rows($run_post_comment);

      if ($post_type != 2 && $post_type!= 3) {
      if ($post_stat != 1) {
        /*--------------------------------------T??I KHO???N C???A NG?????I D??NG HI???N T???I------*/
        
          if($vote_value == 1){
        
            echo "
              <a href='posts.php?post=$post_id'>
              <div class='left-content'>
              <div class='loader-display'>
                    
                </div>
                  <div class='user_post'>
                    <img src='images/$user_pic'>
                    <p style='color: white;'>$user</p>
                    <p style='color: #b0b3b8; border: 1px solid lightgrey; border-radius: 5px;'>$post_cat_name</p>
                    <p style='color: #b0b3b8;'>???? ????ng: $time_ago</p>
                  </div>
                    <h3>$post_name</h3>
                    <div class='post-content'>
                    <p>$post_content</p>
                    </div>
                  <div class='choice'>
                    <p><a href=''>B??nh lu???n: $numComments</a></p>
                    <p><a href='javascript:void(0)' style='color: orange;' class='like' id='$post_id'>Th??ch: $post_like</a></p>
                    <p><a href='javascript:void(0)' class='dislike' id='$post_id'>Kh??ng th??ch: $post_dislike</a></p>
                    <p><a href=''>L?????t xem: $post_view</a></p>
                  </div>
                  <div class='choice-right'>
                    <p><a href='upload.php?edit=$post_id'>S???a</a></p>
                    <p><a href='javascript:void(0)' class='delete' id='$post_id'>X??a</a></p>
                  </div>
              </div>
              </a>

            ";

          }
          if ($vote_value == -1) {
            echo "
              <a href='posts.php?post=$post_id'>
              <div class='left-content'>
              <div class='loader-display'>
                    
                </div>
                  <div class='user_post'>
                    <img src='images/$user_pic'>
                    <p style='color: white;'>$user</p>
                    <p style='color: #b0b3b8; border: 1px solid lightgrey; border-radius: 5px;'>$post_cat_name</p>
                    <p style='color: #b0b3b8;'>???? ????ng: $time_ago</p>
                  </div>
                    <h3>$post_name</h3>
                    <div class='post-content'>
                    <p>$post_content</p>
                    </div>
                  <div class='choice'>
                    <p><a href=''>B??nh lu???n: $numComments</a></p>
                    <p><a href='javascript:void(0)' class='like' id='$post_id'>Th??ch: $post_like</a></p>
                    <p><a href='javascript:void(0)' style='color: blue;' class='dislike' id='$post_id'>Kh??ng th??ch: $post_dislike</a></p>
                    <p><a href=''>L?????t xem: $post_view</a></p>
                  </div>
                  <div class='choice-right'>
                    <p><a href='upload.php?edit=$post_id'>S???a</a></p>
                    <p><a href='javascript:void(0)' class='delete' id='$post_id'>X??a</a></p>
                  </div>
              </div>
              </a>

            ";
          }
          if ($vote_value == 0) {
            echo "
              <a href='posts.php?post=$post_id'>
              <div class='left-content'>
              <div class='loader-display'>
                    
                </div>
                  <div class='user_post'>
                    <img src='images/$user_pic'>
                    <p style='color: white;'>$user</p>
                    <p style='color: #b0b3b8; border: 1px solid lightgrey; border-radius: 5px;'>$post_cat_name</p>
                    <p style='color: #b0b3b8;'>???? ????ng: $time_ago</p>
                  </div>
                    <h3>$post_name</h3>
                    <div class='post-content'>
                    <p>$post_content</p>
                    </div>
                  <div class='choice'>
                    <p><a href=''>B??nh lu???n: $numComments</a></p>
                    <p><a href='javascript:void(0)' class='like' id='$post_id'>Th??ch: $post_like</a></p>
                    <p><a href='javascript:void(0)' class='dislike' id='$post_id'>Kh??ng th??ch: $post_dislike</a></p>
                    <p><a href=''>L?????t xem: $post_view</a></p>
                  </div>
                  <div class='choice-right'>
                    <p><a href='upload.php?edit=$post_id'>S???a</a></p>
                    <p><a href='javascript:void(0)' class='delete' id='$post_id'>X??a</a></p>
                  </div>
              </div>
              </a>

            ";
          }
    
    /*----------------------------------------------------END T??I KHO???N C???A NG?????I D??NG HI???N T???I----*/

    /*------------------------------------------T??I KHO???N KH??C XEM T??I KHO???N N??Y-------------*/
    
    /*----------------------------------END T??I KHO???N KH??C XEM T??I KHO???N N??Y--------------------*/
  }
    /*-------------------------------------------------KH??NG ????NG NH???P-------------------------*/
  else{  
      echo "
        <a href='posts.php?post=$post_id'>
        <div class='left-content'>
        <div class='loader-display'>
              
          </div>
            <div class='user_post'>
              <img src='images/$user_pic'>
              <p style='color: white;'>$user</p>
              <p style='color: #b0b3b8; border: 1px solid lightgrey; border-radius: 5px;'>$post_cat_name</p>
              <p style='color: #b0b3b8;'>???? ????ng: $time_ago</p>
              <p style='color: orange;' >??ang ch??? duy???t</p>
            </div>
              <h3>$post_name</h3>
              <div class='post-content'>
              <p>$post_content</p>
              </div>
            <div class='choice'>
              <p><a href=''>B??nh lu???n: $numComments</a></p>
              <p><a href='javascript:void(0)' class='' id='$post_id'>Th??ch: $post_like</a></p>
              <p><a href='javascript:void(0)' class='' id='$post_id'>Kh??ng th??ch: $post_dislike</a></p>
              <p><a href=''>L?????t xem: $post_view</a></p>
            </div>
            <div class='choice-right'>
              <p><a href='upload.php?edit=$post_id'>S???a</a></p>
              <p><a href='javascript:void(0)' class='delete' id='$post_id'>X??a</a></p>
              
            </div>
        </div>
        </a>

      ";
    
  }
  /*--------------------------------------------END KO ????NG NH???P-----------------------------*/
}
  /*--------------------------------------------N???U B??I VI???T L?? H??NH------------------------*/
    if ($post_type == 2) {
      if ($post_stat != 1) {
        /*----------------------------------T??I KHO???N C???A NG?????I D??NG---------------------------*/
        
      $select_img = "SELECT * FROM images WHERE post_id = '$post_id'";
      $run_img = mysqli_query($conn,$select_img);

      if($vote_value == 1){
      echo "
      <a href='posts.php?post=$post_id'>
        <div class='left-content-2'>
        <div class='loader-display'>
              
              </div>
            <div class='user_post'>
              <img src='images/$user_pic'>
              <p style='color: white;'>$user</p>
              <p style='color: #b0b3b8; border: 1px solid lightgrey; border-radius: 5px;'>$post_cat_name</p>
              <p style='color: #b0b3b8;'>???? ????ng: $time_ago</p>
            </div>
              <h3>$post_name</h3>
      ";

      $row_img = mysqli_fetch_array($run_img);
      $img_name = $row_img['img_name'];

      echo "<img src='images/$img_name'>";

      $num_img = 0;
      while ($row_img = mysqli_fetch_array($run_img)) {
        $num_img++;

      }
      if ($num_img > 0) {
        echo "<p>Xem th??m (+$num_img)</p>";
      }
      echo "<div class='choice'>
          <p><a href=''>B??nh lu???n: $numComments</a></p>
          <p><a href='javascript:void(0)' style='color: orange;' class='like' id='$post_id'>Th??ch: $post_like</a></p>
          <p><a href='javascript:void(0)' class='dislike' id='$post_id'>Kh??ng th??ch: $post_dislike</a></p>
          <p><a href=''>L?????t xem: $post_view</a></p>
          </div>
          <div class='choice-right'>
              <p><a href='upload.php?edit=$post_id'>edit</a></p>
              <p><a href='javascript:void(0)' class='delete' id='$post_id'>delete</a></p>
            </div>
          </div>
          </a>";
    
    }

    if ($vote_value == -1) {
      echo "
      <a href='posts.php?post=$post_id'>
        <div class='left-content-2'>
        <div class='loader-display'>
              
              </div>
            <div class='user_post'>
              <img src='images/$user_pic'>
              <p style='color: white;'>$user</p>
              <p style='color: #b0b3b8; border: 1px solid lightgrey; border-radius: 5px;'>$post_cat_name</p>
              <p style='color: #b0b3b8;'>???? ????ng: $time_ago</p>
            </div>
              <h3>$post_name</h3>
      ";

      $row_img = mysqli_fetch_array($run_img);
      $img_name = $row_img['img_name'];

      echo "<img src='images/$img_name'>";

      $num_img = 0;
      while ($row_img = mysqli_fetch_array($run_img)) {
        $num_img++;

      }
      if ($num_img > 0) {
        echo "<p>Xem th??m (+$num_img)</p>";
      }
      echo "<div class='choice'>
          <p><a href=''>B??nh lu???n: $numComments</a></p>
          <p><a href='javascript:void(0)' class='like' id='$post_id'>Th??ch: $post_like</a></p>
          <p><a href='javascript:void(0)' style='color: blue;' class='dislike' id='$post_id'>Kh??ng th??ch: $post_dislike</a></p>
          <p><a href=''>L?????t xem: $post_view</a></p>
          </div>
          <div class='choice-right'>
              <p><a href='upload.php?edit=$post_id'>S???a</a></p>
              <p><a href='javascript:void(0)' class='delete' id='$post_id'>X??a</a></p>
            </div>
          </div>
          </a>";
    }

    if ($vote_value == 0) {
        echo "
      <a href='posts.php?post=$post_id'>
        <div class='left-content-2'>
        <div class='loader-display'>
              
              </div>
            <div class='user_post'>
              <img src='images/$user_pic'>
              <p style='color: white;'>$user</p>
              <p style='color: #b0b3b8; border: 1px solid lightgrey; border-radius: 5px;'>$post_cat_name</p>
              <p style='color: #b0b3b8;'>???? ????ng: $time_ago</p>
            </div>
              <h3>$post_name</h3>
      ";

      $row_img = mysqli_fetch_array($run_img);
      $img_name = $row_img['img_name'];

      echo "<img src='images/$img_name'>";

      $num_img = 0;
      while ($row_img = mysqli_fetch_array($run_img)) {
        $num_img++;

      }
      if ($num_img > 0) {
        echo "<p>Xem th??m (+$num_img)</p>";
      }
      echo "<div class='choice'>
          <p><a href=''>B??nh lu???n: $numComments</a></p>
          <p><a href='javascript:void(0)' class='like' id='$post_id'>Th??ch: $post_like</a></p>
          <p><a href='javascript:void(0)' class='dislike' id='$post_id'>Kh??ng th??ch: $post_dislike</a></p>
          <p><a href=''>L?????t xem: $post_view</a></p>
          </div>
          <div class='choice-right'>
              <p><a href='upload.php?edit=$post_id'>S???a</a></p>
              <p><a href='javascript:void(0)' class='delete' id='$post_id'>X??a</a></p>
            </div>
          </div>
          </a>";
          }
        
        /*------------------------------------------END T??I KHO???N C???A NG?????I D??NG------------------*/

        /*-----------------------------------------T??I KHO???N KH??C XEM T??I KHO???N N??Y----------------*/
        
      }
      /*------------------------------------------END T??I KHO???N KH??C COI T??I KHO???N N??Y-----*/

      /*------------------------------------------KO ????NG NH???P------------------------------*/
      else{
        echo "
      <a href='posts.php?post=$post_id'>
        <div class='left-content-2'>
        <div class='loader-display'>
              
              </div>
            <div class='user_post'>
              <img src='images/$user_pic'>
              <p style='color: white;'>$user</p>
              <p style='color: #b0b3b8; border: 1px solid lightgrey; border-radius: 5px;'>$post_cat_name</p>
              <p style='color: #b0b3b8;'>???? ????ng: $time_ago</p>
              <p style='color: orange;' >??ang ch??? duy???t</p>
            </div>
              <h3>$post_name</h3>
      ";

      $row_img = mysqli_fetch_array($run_img);
      $img_name = $row_img['img_name'];

      echo "<img src='images/$img_name'>";

      $num_img = 0;
      while ($row_img = mysqli_fetch_array($run_img)) {
        $num_img++;

      }
      if ($num_img > 0) {
        echo "<p>Xem th??m (+$num_img)</p>";
      }
      echo "<div class='choice'>
          <p><a href=''>B??nh lu???n: $numComments</a></p>
          <p><a href='javascript:void(0)' class='' id='$post_id'>Th??ch: $post_like</a></p>
          <p><a href='javascript:void(0)' class='' id='$post_id'>Kh??ng th??ch: $post_dislike</a></p>
          <p><a href=''>L?????t xem: $post_view</a></p>
          </div>
          <div class='choice-right'>
              <p><a href='upload.php?edit=$post_id'>S???a</a></p>
              <p><a href='javascript:void(0)' class='delete' id='$post_id'>X??a</a></p>
              
            </div>
          </div>
          </a>";
      }
      /*-----------------------------------------END KO ????NG NH???P---------------------------*/
    }
  }




        