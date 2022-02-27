<?php 
  session_start();
  require '../connect.php';
  require '../functions.php';
    $user_id = $_POST['user_id'];
    mysqli_set_charset($conn,'UTF8');
    $select_save = "SELECT * FROM save_post WHERE save_user_id = '$user_id'";
    $run_save = mysqli_query($conn,$select_save);
    while ($row_save = mysqli_fetch_array($run_save)) {
      $save_post_id = $row_save['save_post_id'];	
      	
      $select_account = "SELECT * FROM post where post_id = '$save_post_id'";
      $run_account = mysqli_query($conn,$select_account);
      $row_account = mysqli_fetch_array($run_account);		

      $post_name = $row_account['post_name'];
      $post_view = $row_account['post_view'];
      $post_like = $row_account['post_like'];
      $post_dislike = $row_account['post_dislike'];
      $post_id = $row_account['post_id'];
      $post_type = $row_account['post_type'];
      $post_content = $row_account['post_content'];
      $post_date = $row_account['post_date'];
      $post_user_id = $row_account['user_id'];
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
      SELECT * FROM (SELECT '$user_id', '$post_id') AS tmp
      WHERE NOT EXISTS (
          SELECT vote_value FROM vote_status WHERE user_id = '$user_id' AND post_id= '$post_id'
      ) LIMIT 1";
      $run_i_vote = mysqli_query($conn,$insert_vote);

      $get_vote = "SELECT * FROM vote_status WHERE user_id = '$user_id' AND post_id = '$post_id'";
      $run_vote = mysqli_query($conn,$get_vote);
      $row_vote = mysqli_fetch_array($run_vote);
      $vote_value = $row_vote['vote_value'];
      }

      $numComments = 0;

      $get_post_comment = "SELECT post_id FROM comment where post_id = '$post_id'";
      $run_post_comment = mysqli_query($conn,$get_post_comment);
      $numComments = mysqli_num_rows($run_post_comment);

      if ($post_type != 2 && $post_type!= 3) {
      if (isset($_SESSION['userid'])) {
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
              <p style='color: #b0b3b8;'>Đã đăng: $time_ago</p>
            </div>
              <h3>$post_name</h3>
              <div class='post-content'>
              <p>$post_content</p>
              </div>
            <div class='choice'>
              <p><a href=''>Bình luận: $numComments</a></p>
              <p><a href='javascript:void(0)' style='color: orange;' class='like' id='$post_id'>Thích: $post_like</a></p>
              <p><a href='javascript:void(0)' class='dislike' id='$post_id'>Không thích: $post_dislike</a></p>
              <p><a href=''>Lượt xem: $post_view</a></p>
            </div>
            <div class='choice-right'>
              <p><a href='javascript:void(0)' class='delsave' id='s-$post_id'>Hủy lưu</a></p>
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
              <p style='color: #b0b3b8;'>Đã đăng: $time_ago</p>
            </div>
              <h3>$post_name</h3>
              <div class='post-content'>
              <p>$post_content</p>
              </div>
            <div class='choice'>
              <p><a href=''>Bình luận: $numComments</a></p>
              <p><a href='javascript:void(0)' class='like' id='$post_id'>Thích: $post_like</a></p>
              <p><a href='javascript:void(0)' style='color: blue;' class='dislike' id='$post_id'>Không thích: $post_dislike</a></p>
              <p><a href=''>Lượt xem: $post_view</a></p>
            </div>
            <div class='choice-right'>
              <p><a href='javascript:void(0)' class='delsave' id='s-$post_id'>Hủy lưu</a></p>
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
              <p style='color: #b0b3b8;'>Đã đăng: $time_ago</p>
            </div>
              <h3>$post_name</h3>
              <div class='post-content'>
              <p>$post_content</p>
              </div>
            <div class='choice'>
              <p><a href=''>Bình luận: $numComments</a></p>
              <p><a href='javascript:void(0)' class='like' id='$post_id'>Thích: $post_like</a></p>
              <p><a href='javascript:void(0)' class='dislike' id='$post_id'>Không thích: $post_dislike</a></p>
              <p><a href=''>Lượt xem: $post_view</a></p>
            </div>
            <div class='choice-right'>
              <p><a href='javascript:void(0)' class='delsave' id='s-$post_id'>Hủy lưu</a></p>
            </div>
        </div>
        </a>

      ";
    }
  }
}

    if ($post_type == 2) {
      if (isset($_SESSION['userid'])) {
        
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
              <p style='color: #b0b3b8;'>Đã đăng: $time_ago</p>
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
        echo "<p>Xem thêm (+$num_img)</p>";
      }
      echo "<div class='choice'>
          <p><a href=''>Bình luận: $numComments</a></p>
          <p><a href='javascript:void(0)' style='color: orange;' class='like' id='$post_id'>Thích: $post_like</a></p>
          <p><a href='javascript:void(0)' class='dislike' id='$post_id'>Không thích: $post_dislike</a></p>
          <p><a href=''>Lượt xem: $post_view</a></p>
          </div>
          <div class='choice-right'>
              <p><a href='javascript:void(0)' class='delsave' id='s-$post_id'>Hủy lưu</a></p>
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
              <p style='color: #b0b3b8;'>Đã đăng: $time_ago</p>
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
        echo "<p>Xem thêm (+$num_img)</p>";
      }
      echo "<div class='choice'>
          <p><a href=''>Comment: $numComments</a></p>
          <p><a href='javascript:void(0)' class='like' id='$post_id'>Thích: $post_like</a></p>
          <p><a href='javascript:void(0)' style='color: blue;' class='dislike' id='$post_id'>Không thích: $post_dislike</a></p>
          <p><a href=''>Lượt xem: $post_view</a></p>
          </div>
          <div class='choice-right'>
              <p><a href='javascript:void(0)' class='delsave' id='s-$post_id'>Hủy lưu</a></p>
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
              <p style='color: #b0b3b8;'>Đã đăng: $time_ago</p>
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
        echo "<p>Xem thêm (+$num_img)</p>";
      }
      echo "<div class='choice'>
          <p><a href=''>Comment: $numComments</a></p>
          <p><a href='javascript:void(0)' class='like' id='$post_id'>Thích: $post_like</a></p>
          <p><a href='javascript:void(0)' class='dislike' id='$post_id'>Không thích: $post_dislike</a></p>
          <p><a href=''>Lượt xem: $post_view</a></p>
          </div>
          <div class='choice-right'>
              <p><a href='javascript:void(0)' class='delsave' id='s-$post_id'>Hủy lưu</a></p>
            </div>
          </div>
          </a>";
        }
      }
    }
  }




