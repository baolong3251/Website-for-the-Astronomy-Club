<?php

$servername = "localhost";
$dBUsername = "root";
$dBPassword = "";
$dBName = "csdl_clb";

$conn = mysqli_connect($servername, $dBUsername, $dBPassword, $dBName);
mysqli_set_charset($conn,'UTF8');
$select = "SELECT * FROM zodiac_sign";
$run = mysqli_query($conn,$select);

while ($row = mysqli_fetch_array($run)) {
	$star_name = $row['star_name'];
	$star_id = $row['star_id'];
	$star_img = $row['star_img'];
	$star_content = $row['star_content'];
	echo "
		<div class='swiper-slide'><a href='' data-toggle='modal' data-target='#s-$star_id'><img src='zodiac_sign/$star_img'><p style='color: white; text-align: center;'>$star_name</p></a></div>

		<div class='modal fade' id='s-$star_id'>
    
	    <div class='modal-dialog'>
	      
	      <div class='modal-content'>

	        <div class='modal-header text-center'>
	          <h4 class='modal-title text-center font-weight-bold'>$star_name</h4>
	          <button type='button' class='close' data-dismiss='modal' aria-lable='close'>&times;</button>
	        </div>

	        <div class='modal-body mx-3'>
	          <div class='md-form mb-4'>
	              <img src='zodiac_sign/$star_img'>       
	              <div class='md-value'><h5>$star_content</h5></div>     
	          </div>

	        </div>

	      </div>
	    </div>
	  </div>

	";
}