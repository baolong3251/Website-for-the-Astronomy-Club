<?php

$servername = "localhost";
$dBUsername = "root";
$dBPassword = "";
$dBName = "csdl_clb";

$conn = mysqli_connect($servername, $dBUsername, $dBPassword, $dBName);
mysqli_set_charset($conn,'UTF8');
// $conn = new PDO("mysql:host=localhost;dbname=csdl_clb", "root", "");

// $star_id = $_POST['']

// $select = "SELECT * FROM zodiac_sign";
// $run = mysqli_query($conn,$select);
// while ($row = mysqli_fetch_array($run)) {
// 	echo "";
// }
// <img src="zodiac_sign/Aries.jpg">       
// <div class="md-value"><h5>Thêm gì đó...</h5></div>  


//fetch_data.php
/*
if(isset($_POST["action"]))
{
 $query = "
  SELECT * FROM zodiac_sign WHERE
 ";
 if(isset($_POST["star"]))
 {
  $brand_filter = implode("','", $_POST["star"]);
  $query .= "
   star_id IN('".$brand_filter."')
  ";
 }

 $statement = $conn->prepare($query);
 $statement->execute();
 $result = $statement->fetchAll();
 $total_row = $statement->rowCount();
 $output = '';
 if($total_row > 0)
 {
  foreach($result as $row)
  {
   $output .= '
     <img src="zodiac_sign/'. $row['star_img'] .'" alt="">
     <div class="md-value"><h5>'. $row['star_name'] .'</h5><h5>'. $row['star_content'] .'sdadsadasasdasd</h5></div>   
   ';
  }
 }
 else
 {
  $output = '<h3>No Data Found</h3>';
 }
 echo $output;
}

?>
*/

        $star_id = $_POST['star_id2'];
        $select = "SELECT * FROM zodiac_sign where star_id = '$star_id'";
        $run = mysqli_query($conn,$select);
        $row = mysqli_fetch_array($run);
        echo '
             <input type = "hidden" name = "edit-star-id" value="'. $row['star_id'] .'">  
             <img src="zodiac_sign/'. $row['star_img'] .'" alt="" id="'. $row['star_id'] .'" style="cursor: pointer;" class="edit-img">
             <div class="md-value"><textarea name="edit-content" class="form-control edit-content" cols="100" rows="20">'. $row['star_content'] .'</textarea> 
          
        ';
