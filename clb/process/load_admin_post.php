<?php 
//fetch.php
$connect = mysqli_connect("localhost", "root", "", "csdl_clb");
$output = '';
mysqli_set_charset($connect,'UTF8');
if(isset($_POST["query"]))
{
 $search = mysqli_real_escape_string($connect, $_POST["query"]);
 $query = "
  SELECT * FROM post 
  WHERE post_name LIKE '%".$search."%' AND post_stat = '0'
 ";
}
else
{
 $query = "
  SELECT * FROM post where post_stat = '0' ORDER BY post_date DESC
 ";
}
$result = mysqli_query($connect, $query);
if(mysqli_num_rows($result) > 0)
{
  
 while($row = mysqli_fetch_array($result))
 {
  $output .= '
   <tr>
    <th scope="row">'.$row["post_id"].'</th>
    <td><a href="posts.php?post='.$row["post_id"].'">'.$row["post_name"].'</a></td>
    <td>'.$row["post_view"].'</td>
    <td>'.$row["post_like"].'</td>
    <td>'.$row["post_dislike"].'</td>
    <td><a href="javascript:void(0)" id="'.$row["post_id"].'" class="delete2">Xóa</a></td>
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