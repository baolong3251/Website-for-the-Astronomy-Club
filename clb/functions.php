<!--  https://www.spaceotechnologies.com/php-event-calendar-jquery-ajax/  -->

<?php 
		// function update_user_point(){
		// 	require 'connect.php';
		// 	$get_update = "UPDATE users c
		// 					INNER JOIN (
		// 					  SELECT post_user_id, SUM(post_point) as total
		// 					  FROM post
		// 					  GROUP BY post_user_id
		// 					) x ON c.ID = x.post_user_id
		// 					SET c.user_point = x.total";
		// 	$run_update = mysqli_query($conn,$get_update);
		// }

		function update_user_rank(){
			require 'connect.php';
			$get_update = "UPDATE  users
			JOIN     (SELECT    p.user_id,
			                    IF(@lastPoint <> p.user_point, 
			                       @curRank := @curRank + 1, 
			                       @curRank)  AS rank,
			                    @lastPoint := p.user_point
			          FROM      users p
			          JOIN      (SELECT @curRank := 0, @lastPoint := 0) r
			          ORDER BY  p.user_point DESC
			         ) ranks ON (ranks.user_id = users.user_id)
			SET      users.user_rank = ranks.rank";
			$run_update = mysqli_query($conn,$get_update);

		}


	function edit_post(){
		if (isset($_POST['submit'])) {
			require 'connect.php';
		$editorContent = $_POST['editor'];
		$post_name = $_POST['post_title'];
		$post_tag = $_POST['post_tag'];
		$post_user_id = $_POST['post_user_id'];
		$post_id = $_POST['post_id'];
		$post_exp_date = $_POST['exp_date_2'];
		if (!empty($post_name)){

			if (!empty($editorContent)) {

				if ($post_tag == "") {
					$edit = $conn->query("UPDATE post SET post_content = '$editorContent', post_name = '$post_name'  WHERE post_id = '$post_id'");
				}else{
					$edit = $conn->query("UPDATE post SET post_content = '$editorContent', post_name = '$post_name', post_type = '$post_tag'  WHERE post_id = '$post_id'");
				}

				if ($post_exp_date != "") {
					$edit2 = $conn->query("UPDATE post SET post_exp_date= '$post_exp_date'  WHERE post_id = '$post_id'");
				}
			
			if ($edit) {
					echo "<script>alert('Sửa thành công!!')</script>";
					echo "<script>window.open('upload.php?edit=$post_id','_self')</script>";

				}
			}
		}
	}
}	


	function upload_img(){ 
if(isset($_POST['submit-img'])){ 
    // Include the database configuration file 
    require 'connect.php';

    $post_user_id = $_POST['post_user_id'];
    $post_title = $_POST['post_title'];
    

    // File upload configuration 
    $targetDir = "images/"; 
    $allowTypes = array('jpg','png','jpeg','gif'); 
    if (!empty($post_title)) {
    $statusMsg = $errorMsg = $insertValuesSQL = $errorUpload = $errorUploadType = ''; 
    $fileNames = array_filter($_FILES['files']['name']); 
    if(!empty($fileNames)){ 

    	$insert_post = "INSERT INTO post (user_id, post_name, post_type, post_stat)

	    VALUES ('$post_user_id', '$post_title', '2', '1')";

	    $run_post = mysqli_query($conn,$insert_post);

	    
	    $last_id = mysqli_insert_id($conn);

        foreach($_FILES['files']['name'] as $key=>$val){ 
            // File upload path 
            $fileName = basename($_FILES['files']['name'][$key]); 
            $targetFilePath = $targetDir . $fileName; 
             
            // Check whether file type is valid 
            $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION); 
            if(in_array($fileType, $allowTypes)){ 
                // Upload file to server 
                if(move_uploaded_file($_FILES["files"]["tmp_name"][$key], $targetFilePath)){ 
                    // Image db insert sql 
                    $insertValuesSQL .= "('".$fileName."', '".$last_id."'),"; 
                }else{ 
                    $errorUpload .= $_FILES['files']['name'][$key].' | '; 
                } 
            }else{ 
                $errorUploadType .= $_FILES['files']['name'][$key].' | '; 
            } 
        } 
         
        if(!empty($insertValuesSQL)){ 
            $insertValuesSQL = trim($insertValuesSQL, ','); 
            // Insert image file name into database 
            $insert = $conn->query("INSERT INTO images (img_name, post_id) VALUES $insertValuesSQL"); 
            if($insert){ 
                $errorUpload = !empty($errorUpload)?'Upload Error: '.trim($errorUpload, ' | '):''; 
                $errorUploadType = !empty($errorUploadType)?'File Type Error: '.trim($errorUploadType, ' | '):''; 
                $errorMsg = !empty($errorUpload)?'<br/>'.$errorUpload.'<br/>'.$errorUploadType:'<br/>'.$errorUploadType; 
                $statusMsg = "Ảnh đã được thêm.".$errorMsg;
                $update = "UPDATE users SET num_post=num_post+1 where user_id = '$post_user_id'";
                $run_up = mysqli_query($conn,$update); 
            }else{ 
                $statusMsg = "Sorry, there was an error uploading your file."; 
            } 
        } 
    }else{ 
       	
        $statusMsg = 'Xin hãy chọn ảnh.'; 
		
    }
    }else{
        $statusMsg = 'Tựa bài viết không được để trống.';
    } 
     
    // Display status message 
    echo $statusMsg; 
		 
		
	}

	//--------------------EDIT IMG

	if(isset($_POST['submit-edit-img'])){ 
    // Include the database configuration file 
    require 'connect.php';

    $post_user_id = $_POST['post_user_id'];
    $post_title = $_POST['post_title'];
    $post_id = $_POST['post_id'];
    
    if(!empty($post_title)){
    	$update = "UPDATE post SET post_name = '$post_title' where post_id = '$post_id'";
    	$run_up = mysqli_query($conn,$update);
    }

    // File upload configuration 
    $targetDir = "images/"; 
    $allowTypes = array('jpg','png','jpeg','gif'); 
     
    $statusMsg = $errorMsg = $insertValuesSQL = $errorUpload = $errorUploadType = ''; 
    $fileNames = array_filter($_FILES['files']['name']); 
    if(!empty($fileNames)){ 
        foreach($_FILES['files']['name'] as $key=>$val){ 
            // File upload path 
            $fileName = basename($_FILES['files']['name'][$key]); 
            $targetFilePath = $targetDir . $fileName; 
             
            // Check whether file type is valid 
            $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION); 
            if(in_array($fileType, $allowTypes)){ 
                // Upload file to server 
                if(move_uploaded_file($_FILES["files"]["tmp_name"][$key], $targetFilePath)){ 
                    // Image db insert sql 
                    $insertValuesSQL .= "('".$fileName."', '".$post_id."'),"; 
                }else{ 
                    $errorUpload .= $_FILES['files']['name'][$key].' | '; 
                } 
            }else{ 
                $errorUploadType .= $_FILES['files']['name'][$key].' | '; 
            } 
        } 
         
        if(!empty($insertValuesSQL)){ 
            $insertValuesSQL = trim($insertValuesSQL, ','); 
            // Insert image file name into database 
            $insert = $conn->query("INSERT INTO images (img_name, post_id) VALUES $insertValuesSQL"); 
            if($insert){ 
                $errorUpload = !empty($errorUpload)?'Upload Error: '.trim($errorUpload, ' | '):''; 
                $errorUploadType = !empty($errorUploadType)?'File Type Error: '.trim($errorUploadType, ' | '):''; 
                $errorMsg = !empty($errorUpload)?'<br/>'.$errorUpload.'<br/>'.$errorUploadType:'<br/>'.$errorUploadType; 
                echo "<script>alert('Thành công!!')</script>";
				echo "<script>window.open('upload.php?edit=$post_id','_self')</script>";
            }else{ 
                echo "<script>alert('Sorry, there was an error uploading your file.')</script>";
				echo "<script>window.open('upload.php?edit=$post_id','_self')</script>";
            } 
        } 
    }else{ 
        
        echo "<script>alert('Xin hãy chọn ảnh.')</script>";
		echo "<script>window.open('upload.php?edit=$post_id','_self')</script>";
    } 
     
    // Display status message 
    echo $statusMsg; 
		
		
	}

	//-------------------------------UPLOAD IMAGE EVENT TO DATABASE

	if (isset($_POST['submit-img-event'])) {

		// Include the database configuration file 
    require 'connect.php';
    
    $post_user_id = $_POST['post_user_id'];
    $last_id = '';

    // File upload configuration 
    $targetDir = "images/"; 
    $allowTypes = array('jpg','png','jpeg','gif'); 
     
    $statusMsg = $errorMsg = $insertValuesSQL = $errorUpload = $errorUploadType = ''; 
    $fileNames = array_filter($_FILES['files']['name']); 
    if(!empty($fileNames)){ 
        foreach($_FILES['files']['name'] as $key=>$val){ 
            // File upload path 
            $fileName = basename($_FILES['files']['name'][$key]); 
            $targetFilePath = $targetDir . $fileName; 
             
            // Check whether file type is valid 
            $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION); 
            if(in_array($fileType, $allowTypes)){ 
                // Upload file to server 
                if(move_uploaded_file($_FILES["files"]["tmp_name"][$key], $targetFilePath)){ 
                    // Image db insert sql 
                    $insertValuesSQL .= "('".$fileName."', '".$last_id."'),"; 
                }else{ 
                    $errorUpload .= $_FILES['files']['name'][$key].' | '; 
                } 
            }else{ 
                $errorUploadType .= $_FILES['files']['name'][$key].' | '; 
            } 
        } 
         
        if(!empty($insertValuesSQL)){ 
            $insertValuesSQL = trim($insertValuesSQL, ','); 
            // Insert image file name into database 
            $insert = $conn->query("INSERT INTO images (img_name, post_id) VALUES $insertValuesSQL"); 
            if($insert){ 
                $errorUpload = !empty($errorUpload)?'Upload Error: '.trim($errorUpload, ' | '):''; 
                $errorUploadType = !empty($errorUploadType)?'File Type Error: '.trim($errorUploadType, ' | '):''; 
                $errorMsg = !empty($errorUpload)?'<br/>'.$errorUpload.'<br/>'.$errorUploadType:'<br/>'.$errorUploadType; 
                $statusMsg = "Files are uploaded successfully.".$errorMsg; 
            }else{ 
                $statusMsg = "Sorry, there was an error uploading your file."; 
            } 
        } 
    }else{ 
        $statusMsg = 'Please select a file to upload.'; 
    } 
     
    // Display status message 
    echo $statusMsg; 
		

	}
}

function time_elapsed_string($datetime, $full = false) {
	date_default_timezone_set('Asia/Ho_Chi_Minh');
    $now = new DateTime;
    $ago = new DateTime($datetime);
    $diff = $now->diff($ago);

    $diff->w = floor($diff->d / 7);
    $diff->d -= $diff->w * 7;

    $string = array(
        'y' => 'năm',
        'm' => 'tháng',
        'w' => 'tuần',
        'd' => 'ngày',
        'h' => 'giờ',
        'i' => 'phút',
        's' => 'giây',
    );
    foreach ($string as $k => &$v) {
        if ($diff->$k) {
            $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? '' : '');
        } else {
            unset($string[$k]);
        }
    }

    if (!$full) $string = array_slice($string, 0, 1);
    return $string ? implode(', ', $string) . ' trước' : 'just now';
}
function auto_del(){
	require 'connect.php';

	$sql = "DELETE FROM post WHERE post_type = 3 AND post_exp_date <= CURRENT_TIMESTAMP()";

	$result = mysqli_query($conn,$sql) or die("Error connecting to database!");

}

function update_chart_view(){
	require 'connect.php';
	$month_tmp = date('F');
	$year = date('Y');
    $month = '';
    switch ($month_tmp) {
      case "January":
        $month = "Tháng 1";
        break;
      case "February":
        $month = "Tháng 2";
        break;
      case "March":
        $month = "Tháng 3";
        break;
      case "April":
        $month = "Tháng 4";
        break;
      case "May":
        $month = "Tháng 5";
        break;
      case "June":
        $month = "Tháng 6";
        break;
      case "July":
        $month = "Tháng 7";
        break;
      case "August":
        $month = "Tháng 8";
        break;
      case "September":
        $month = "Tháng 9";
        break;
      case "October":
        $month = "Tháng 10";
        break;
      case "November":
        $month = "Tháng 11";
        break;
      case "December":
        $month = "Tháng 12";
        break;                    
    }
	$insert_chart = "INSERT INTO chart_data (year, month)
	SELECT * FROM (SELECT '$year', '$month') AS tmp
	WHERE NOT EXISTS (
	    SELECT view FROM chart_data WHERE year = '$year' AND month= '$month'
	) LIMIT 1";
	$run_chart = mysqli_query($conn,$insert_chart);
    mysqli_set_charset($conn,'UTF8');
	$update_view = "UPDATE chart_data SET view=view+1 WHERE year = '$year' AND month= '$month'";
	$run_up = mysqli_query($conn,$update_view);

}

function update_comment_point(){
	require 'connect.php';
	$select = "SELECT * FROM comment";
	$run = mysqli_query($conn,$select);
	while($row = mysqli_fetch_array($run)){
		$count = 0;
		$comment_id = $row['comment_id'];
		$select2 = "SELECT * FROM comment where comment_parent = '$comment_id'";
		$run2 = mysqli_query($conn,$select2);
		$count = mysqli_num_rows($run2);
		$update = "UPDATE comment SET comment_point = '$count' where comment_id = '$comment_id'";
		$run3 = mysqli_query($conn,$update);
	}
}

	
	