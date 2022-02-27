<?php

//fetch.php

$conn = new PDO("mysql:host=localhost;mysql:charset=utf8;dbname=csdl_clb", "root", "");

if(isset($_POST["year"]))
{
 $query = "
 SELECT * FROM chart_data 
 WHERE year = '".$_POST["year"]."' 
 ORDER BY chart_id ASC
 ";
 $statement = $conn->prepare($query);
 $statement->execute();
 $result = $statement->fetchAll();
 foreach($result as $row)
 {
  $output[] = array(
   'month'   => $row["month"],
   'view'  => floatval($row["view"])
  );
 }
 echo json_encode($output);
}

?>
