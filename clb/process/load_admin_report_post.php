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
  WHERE post_name LIKE '%".$search."%' AND post_stat < 0
 ";
}
else
{
 $query = "
  SELECT * FROM post where post_stat < 0 ORDER BY post_stat ASC
 ";
}
$result = mysqli_query($connect, $query);
if(mysqli_num_rows($result) > 0)
{
  
 while($row = mysqli_fetch_array($result))
 {
    $num_re = $row["post_stat"] * (-1);
  $output .= '
   <tr>
    <td scope="row"><a href="posts.php?post='.$row["post_id"].'">'.$row["post_name"].'</a></td>
    <td>'.$num_re.'</td>
    <td>
    <a style = "margin-right: 5px;" href="javascript:void(0)" id="ur-'.$row["post_id"].'" class="unreport">Hủy báo cáo</a>
    <a href="javascript:void(0)" id="dp-'.$row["post_id"].'" class="delpost">Xóa bài</a>
    </td>
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