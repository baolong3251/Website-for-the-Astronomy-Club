<?php 

	require '../connect.php';
	$post_id = $_POST['post_id'];
	mysqli_set_charset($conn,'UTF8');
	$select = "SELECT * FROM images WHERE post_id = '$post_id'";
	$run = mysqli_query($conn,$select);
	while ($row = mysqli_fetch_array($run)) {
		$img_name = $row['img_name'];
		$img_id = $row['img_id'];
		echo "
			<div class='row_img'>
				<div class='per_img'>
                   <a href='images/$img_name' class='fancybox' data-fancybox='gallery1'>
                       
                            <img style='max-width: 200px; max-height: 200px;' src='images/$img_name'>
                            <br><a href='javascript:void(0)' class='delete_img' id='$img_id'>Xóa</a>
                        
                    </a>
                </div>
            </div>


		";
	}




?>