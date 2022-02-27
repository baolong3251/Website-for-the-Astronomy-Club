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
  WHERE post_name LIKE '%".$search."%' AND post_type = 3
 ";
}
else
{
 $query = "
  SELECT * FROM post where post_type = 3 ORDER BY post_id
 ";
}
$result = mysqli_query($connect, $query);
if(mysqli_num_rows($result) > 0)
{
  
 while($row = mysqli_fetch_array($result))
 {
  $output .= '
   <tr>
    <th scope="row">'.$row["post_name"].'</th>
    <td>'.$row["post_view"].'</td>
    <td><a href="javascript:void(0)" id="'.$row["post_id"].'" class="delete4" style="margin-right: 10px;">Xóa</a>
    <a href="upload.php?edit='.$row["post_id"].'" id="'.$row["post_id"].'" class="edit4">Sửa</a></td>
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