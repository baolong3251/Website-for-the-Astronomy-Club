<?php
require '../connect.php';
$user_id = $_POST['user_id'];
mysqli_set_charset($conn,'UTF8');
$select = "SELECT * FROM users where user_id='$user_id'";
$run_select = mysqli_query($conn,$select);
$row_select = mysqli_fetch_array($run_select);
$user = $row_select['user_name'];
$ID = $row_select['user_id'];

echo "
<div class='md-form'>
<input type='text' class='form-control validate' name='edit_name_value' id='' value = '$user'>
</div>
<div class='md-form'>
<input type='hidden' name='user_id_account_2' value='$ID'>
</div>

";