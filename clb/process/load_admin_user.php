<?php
//fetch.php
$connect = mysqli_connect("localhost", "root", "", "csdl_clb");
$output = '';
mysqli_set_charset($connect,'UTF8');
if(isset($_POST["query"]))
{
 $search = mysqli_real_escape_string($connect, $_POST["query"]);
 $query = "
  SELECT * FROM users 
  WHERE user_name LIKE '%".$search."%'
 ";
}
else
{
 $query = "
  SELECT * FROM users where user_name != 'admin' ORDER BY user_id
 ";
}
$result = mysqli_query($connect, $query);
if(mysqli_num_rows($result) > 0)
{
  
 while($row = mysqli_fetch_array($result))
 {
  $output .= '
   <tr>
    <th scope="row">'.$row["user_rank"].'</td>
    <td>'.$row["user_name"].'</td>
    <td><a href="#" id="'.$row["user_id"].'" class="user_post">'.$row["num_post"].'</a></td>
    <td>'.$row["user_point"].'</td>
    <td><a href="#" id="'.$row["user_id"].'" class="delete">Xóa</a></td>
   </tr>
  ';
 }
 echo $output;
}
else
{
 echo 'Không tìm thấy bất cứ kết quả nào.';
}

?>