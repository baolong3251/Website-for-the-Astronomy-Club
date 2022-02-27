<?php 
//fetch.php
$connect = mysqli_connect("localhost", "root", "", "csdl_clb");
$output = '';
mysqli_set_charset($connect,'UTF8');
if(isset($_POST["query"]))
{
 $search = mysqli_real_escape_string($connect, $_POST["query"]);
 $query = "
  SELECT * FROM post_categories 
  WHERE post_cat_name LIKE '%".$search."%' AND post_type != 1 AND post_type != 2 AND post_type != 3
 ";
}
else
{
 $query = "
  SELECT * FROM post_categories where (post_type != 1 AND post_type != 2 AND post_type != 3) ORDER BY post_type 
 ";
}
$result = mysqli_query($connect, $query);
if(mysqli_num_rows($result) > 0)
{
  
 while($row = mysqli_fetch_array($result))
 {
  $output .= '
   <tr>
    <th scope="row">'.$row["post_cat_name"].'</th>
    <td><a href="javascript:void(0)" id="'.$row["post_type"].'" class="delete3">Xóa</a></td>
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