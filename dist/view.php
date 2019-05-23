<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel="stylesheet" href="css/style.css">
	<title>Image Gallery | No Database</title>
</head>
<body>

	<!-- Header Section -->
	<h1 class="viewpage-heading bg-dark">View Or Download The Image</h1>

	<!-- Breadcrumb -->
	<ol class="breadcrumb">
		<li class="breadcrumb-item">
			<a href="index.php">Home</a>
		</li>
		<li class="breadcrumb-item">
			View Image
		</li>
	</ol>

	<div class="container mt-5 mb-5">
		<?php
			if (isset($_GET['image'])) {
				$extractImage = explode('_', $_GET['image']);
				$image = end($extractImage);

				echo '<img class="w-100" src="uploads/images/'.$image.'" alt="">';
			} else {
				echo '<h3 class="text-center">Something Went Wrong!</h3>';
			}
		?>
	</div>

	<script type="text/javascript" src="js/jquery-3.3.1.min.js"></script>
	<script type="text/javascript" src="js/jquery.scrollUp.min.js"></script>
	<script type="text/javascript" src="js/main.js"></script>
</body>
</html>
