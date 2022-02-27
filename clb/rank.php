<?php 
  require 'connect.php';
  session_start();
  include ('functions.php');
  // update_user_point();
  update_user_rank();
  if (isset($_SESSION['userid'])) {
  
  $user_id = $_SESSION['userid'];
  $user_name = $_SESSION['useruid'];


}
  mysqli_set_charset($conn,'UTF8');
  $query = "SELECT * FROM users where user_name != 'admin' ORDER BY user_point DESC";  
  $result = mysqli_query($conn,$query);
  

?>

<!DOCTYPE html>
<html>
<head>
  <title></title>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.11.2/css/all.css">
  
  <link rel="stylesheet" href="css/style-main.css">
  
  <link rel="stylesheet" href="jarallax.css">
  
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css">
  
  <link href="https://fonts.googleapis.com/css2?family=Merienda&display=swap" rel="stylesheet">
  
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;700&display=swap" rel="stylesheet">
  
  <!-- <link href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.2/animate.min.css" rel="stylesheet"> -->

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>

  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
  
  <script defer src="https://use.fontawesome.com/releases/v5.11.1/js/all.js">
          




  </script>
  <style>
     <?php include ('css/style-main.css'); ?>
     <?php include ('css/style-rank.css'); ?>
      
      
  </style>
</head>
<body>


   
    <div class="container">
      <div class="top outside-box">
        <a href="index.php">
        <!-- <i class="fas fa-long-arrow-alt-left"></i> -->
          Home
        </a>
      </div>

      <?php 
        if (isset($_SESSION['userid'])) {
          $query2 = "SELECT * FROM users where user_id = '$user_id'";  
          $result2 = mysqli_query($conn,$query2);
          $row2 = mysqli_fetch_array($result2);
          // echo "<a href='#$user_name-$user_id'>Hạng của bạn</a>";
          $user_rank2 = $row2['user_rank'];
          echo "<p class='current-rank outside-box'>Hạng hiện tại của bạn là: $user_rank2 </p>";
        }
      ?>
    <div class="center">
    <table class="table table-striped table-dark">
      <thead class="thead-dark">
        <tr>
          <th class="head" scope="col">Hạng</th>
          <th class="head" scope="col">Tên</th>
          <th class="head" scope="col">Số bài đã đăng</th>
          <th class="head" scope="col">Điểm</th>
        </tr>
      </thead>
  <tbody>
    <?php  
       

        while($row = mysqli_fetch_array($result))  
          {  
            $id = $row['user_id'];
            
        ?>  
    <tr>
      <th scope="row"><?php echo $row['user_rank']; ?><input id="<?php echo "$id"; ?>" data-order="desc" type="hidden" name="" value="<?php echo $id; ?>"></th>
      <td id="<?php echo $row['user_name']."-$id"; ?>"><?php echo $row['user_name']; ?></td>
      <td><?php echo $row['num_post']; ?></td>
      <td><?php echo $row['user_point']; ?></td>
    </tr>
    <?php 
      }
    ?>
  </tbody>
</table>
</div>
</div>



  
  <!-- <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script> -->
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js"></script>


  
  

    

</body>
</html>