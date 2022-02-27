<?php
require '../connect.php';
$user_id = $_POST['user_id'];
mysqli_set_charset($conn,'UTF8');
$select = "SELECT * FROM users where user_id='$user_id'";
$run_select = mysqli_query($conn,$select);
$row_select = mysqli_fetch_array($run_select);
$user_full_name = $row_select['user_full_name'];
$ID = $row_select['user_id'];

echo "
<div class='md-form'>
<input type='text' class='form-control validate' placeholder='Nhập tên vào đây' name='edit_fullname_value' id='' value = '$user_full_name'>
</div>
<div class='md-form'>
<input type='hidden' name='user_id_account_3' value='$ID'>
</div>

";