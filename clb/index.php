<?php
	session_start();
	include ('functions.php');
	// update_user_point();
	update_user_rank();
	auto_del();
	update_chart_view();
?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
	<meta charset="UTF-8">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.11.2/css/all.css">
	<link rel="stylesheet" href="css/style-main.css">
	<link rel="stylesheet" href="jarallax.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<link href="https://fonts.googleapis.com/css2?family=Merienda&display=swap" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;700&display=swap" rel="stylesheet">
	<link href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.2/animate.min.css" rel="stylesheet">
	<!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous"> -->
	<script defer src="https://use.fontawesome.com/releases/v5.11.1/js/all.js">

	</script>
	<style>

	</style>
</head>
<body>
	<?php include ('header.php'); ?>


	<!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.min.js"></script> -->
		<!-- <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script> -->
	 	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
	  	<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js"></script>

	<script>
		function starts(){
			const count = 100;
			const section = document.querySelector('body');
			var i = 0;

			while(i<count){
				const star = document.createElement('i');
				const x = Math.floor(Math.random() * window.innerWidth);
				const y = Math.floor(Math.random() * window.innerHeight);

				const size = Math.random() * 4;
				star.style.left = x-10+'px';
				star.style.top = y-10+'px';
				star.style.width = 1+size+'px';
				star.style.height = 1+size+'px';

				const duration = Math.random() * 2;

				star.style.animationDuration = 2+duration+'s';
				star.style.animationDelay = 2+duration+'s';

				section.appendChild(star);
				i++
			}
		}
		starts();
	</script>

	<script src="js/jarallax.js"></script>
	<script src="js/jarallax-element.js"></script>	
	<script type="text/javascript">
		jarallax(document.querySelectorAll('.jarallax'), {
    		speed: 0.5
		});
	</script>

</body>
</html>