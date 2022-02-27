<?php
require '../functions.php';
//fetch_comment.php
$conn = new PDO('mysql:host=localhost; mysql:charset=utf8;dbname=csdl_clb', 'root', '');
$product_id = $_POST['product_id'];
$comment_user_id = $_POST['comment_user_id'];

$query = "
SELECT * FROM comment 
WHERE comment_parent = '0' AND post_id= '$product_id'
ORDER BY comment_id DESC 
";

$statement = $conn->prepare($query);

$statement->execute();

$result = $statement->fetchAll();
$output = '';

foreach($result as $row)
{
  $user_id = $row["user_id"];
  $select_img = "SELECT * FROM users 
  WHERE user_id = '$user_id'";
  $statement2 = $conn->prepare($select_img);

  $statement2->execute();

  $result2 = $statement2->fetchAll();

  foreach($result2 as $row_img){


  if ($comment_user_id == $row["user_id"]) {
  
 $output .= '
 <div>
 <div class="comment">
  <div style="width: 60px;"><img style="max-width: 50px; max-height: 50px;" src="images/'.$row_img["user_pic"].'"></div>
    <div class="inner-comment">
  <a href="account_2.php"><div class="user"> '.$row_img["user_name"].'</div></a>
  <div class="userComment" id="value-'.$row["comment_id"].'">'.$row["comment_value"].'</div>
    </div>
    </div>
  <div class="container-edit">
  <div class=""><button type="button" class="btn btn-default reply" id="'.$row["comment_id"].'">Trả lời</button></div>
  <div class=""><button class="btn btn-default delete" name="comment_delete" id="'.$row["comment_id"].'">Xóa</button></div>
  <div class=""><button class="btn btn-default edit" name="comment_edit" value="'.$row["comment_value"].'" id="'.$row["comment_id"].'">Sửa</button></div>
  </div>
 </div>
 <hr>
 ';}else{
  $output .= '
 <div>
 <div class="comment">
  <div style="width: 60px;"><img style="max-width: 50px; max-height: 50px;" src="images/'.$row_img["user_pic"].'"></div>
    <div class="inner-comment">
  <a href="user.php?user='.$user_id.'"><div class="user"> '.$row_img["user_name"].'</div></a>
  <div class="userComment" id="value-'.$row["comment_id"].'">'.$row["comment_value"].'</div>
    </div>
    </div>
  <div class="container-edit">
    <div class=""><button type="button" class="btn btn-default reply" id="'.$row["comment_id"].'">Trả lời</button></div>
  </div>
 </div>
 <hr>
 ';
  }
 $output .= get_reply_comment($conn, $row["comment_id"]);
 }
}

echo $output;

function get_reply_comment($conn, $parent_id = 0, $marginleft = 0)
{
 $query = "
 SELECT * FROM comment WHERE comment_parent = '".$parent_id."'
 ";
 $output = '';
 $statement = $conn->prepare($query);
 $statement->execute();
 $result = $statement->fetchAll();
 $count = $statement->rowCount();
 $comment_user_id = $_POST['comment_user_id'];
 if($parent_id == 0)
 {
  $marginleft = 0;
 }
 else
 {
  $marginleft = $marginleft + 48;
 }
 if($count > 0)
 {
  foreach($result as $row)
  {
    $user_id = $row["user_id"];
    $select_img = "SELECT * FROM users 
    WHERE user_id = '$user_id'";
    $statement2 = $conn->prepare($select_img);

    $statement2->execute();

    $result2 = $statement2->fetchAll();

    foreach($result2 as $row_img){

    if ($comment_user_id == $row["user_id"]) {
   $output .= '
   <div>
   <div class="comment" style="margin-left:'.$marginleft.'px">
    <div style="width: 60px;"><img style="max-width: 50px; max-height: 50px;" src="images/'.$row_img["user_pic"].'"></div>
    <div>
  <a href="account_2.php"><div class="user"> '.$row_img["user_name"].'</div></a>
  <div class="userComment" id="value-'.$row["comment_id"].'">'.$row["comment_value"].'</div>
    </div>
    </div>
  <div class="container-edit" style="margin-left:'.$marginleft.'px">
  <div class=""><button type="button" class="btn btn-default reply" id="'.$row["comment_id"].'">Trả lời</button></div>
  <div class=""><button class="btn btn-default delete" name="comment_delete" id="'.$row["comment_id"].'">Xóa</button></div>
  <div class=""><button class="btn btn-default edit" name="comment_edit" value="'.$row["comment_value"].'" id="'.$row["comment_id"].'">Sửa</button></div>
  </div>
 </div>
 <hr>
   ';}
   else{
    $output .= '
   <div>
   <div class="comment" style="margin-left:'.$marginleft.'px">
    <div style="width: 60px;"><img style="max-width: 50px; max-height: 50px;" src="images/'.$row_img["user_pic"].'"></div>
    <div>
  <a href="user.php?user='.$user_id.'"><div class="user"> '.$row_img["user_name"].'</div></a>
  <div class="userComment" id="value-'.$row["comment_id"].'">'.$row["comment_value"].'</div>
    </div>
    </div>
  <div class="container-edit" style="margin-left:'.$marginleft.'px">
    <div class=""><button type="button" class="btn btn-default reply" id="'.$row["comment_id"].'">Trả lời</button></div>
  </div>
 </div>
 <hr>
   ';
   }
   $output .= get_reply_comment($conn, $row["comment_id"]);
  }
 }
}
 return $output;
}

?>