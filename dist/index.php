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
	<header>
		<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
			<a href="index.html" class="navbar-brand">Image Gallery</a>

			<ul class="navbar-nav">
				<li class="nav-item">
					<a href="#gallery" id="gallery-link" class="nav-link">Gallery</a>
				</li>
			</ul>
		</nav>
	</header><!-- /header -->

	<!-- Main Section -->
	<div class="container showcase mt-5">

		<?php
			if (isset($_GET['upload'])) {
				$upload = $_GET['upload'];

				if ($upload === 'empty') {
					echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
			Please select a file to upload.
			<button type="button" class="close" data-dismiss="alert" aria-label="close">
				<span aria-hidden="true">&times;</span>
			</button>
		</div>';
				} else if ($upload === 'not-allowed') {
					echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
			You can upload only jpeg, jpg, png extensions files.
			<button type="button" class="close" data-dismiss="alert" aria-label="close">
				<span aria-hidden="true">&times;</span>
			</button>
		</div>';
				} else if ($upload === 'error') {
					echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
			Something went wrong, try again.
			<button type="button" class="close" data-dismiss="alert" aria-label="close">
				<span aria-hidden="true">&times;</span>
			</button>
		</div>';
				} else if ($upload === 'big-file-size') {
					echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
			File size must be less than 2MB.
			<button type="button" class="close" data-dismiss="alert" aria-label="close">
				<span aria-hidden="true">&times;</span>
			</button>
		</div>';
				} else if ($upload === 'success') {
					echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
			Your file uploaded successfully.
			<button type="button" class="close" data-dismiss="alert" aria-label="close">
				<span aria-hidden="true">&times;</span>
			</button>
		</div>';
				}
			}
		?>

		<h1 class="mb-3">Upload and View Images</h1>
		<h2 class="sub-heading mb-3">Select the image to upload</h2>
		<form action="includes/upload.inc.php" method="POST" enctype="multipart/form-data">
			<div class="form-group bg-light border mb-4">
				<input type="file" name="file" class="form-control-file">
			</div>
			<div class="btn-wrapper mb-4">
				<button type="submit" name="upload" class="btn btn-primary">Upload</button>
			</div>
		</form>
		<p class="text-muted placeholder">Image Formats Allowed : <strong>JPEG JPG</strong> and <strong>PNG</strong></p>
		<p class="text-muted placeholder">File Size : Less Than <strong>2MB</strong></p>
	</div>

	<!-- Gallery Section -->
	<div id="gallery" class="gallery-wrapper mt-5 mb-5">
		<h2 class="p-3 mb-4 text-uppercase">Gallery</h2>
		<div class="container">
			<div class="row">

				<?php
					$path = 'uploads/thumb';
					//	Reomving the '..' & '.' from the array
					$images = array_diff(scandir($path, 1), array('..', '.'));

					foreach ($images as $image) {
						echo '<div class="col-lg-3 col-md-4 col-sm-6">
					<a href="view.php?image='.$image.'" class="d-block mb-4 h-100">
						<img class="img-fluid img-thumbnail" src="uploads/thumb/'.$image.'" alt="">
					</a>
				</div>';
					}
				?>

		</div>
	</div>

	<script type="text/javascript" src="js/jquery-3.3.1.min.js"></script>
	<script type="text/javascript" src="js/jquery.scrollUp.min.js"></script>
	<script type="text/javascript" src="js/bootstrap.min.js"></script>
	<script type="text/javascript" src="js/main.js"></script>
</body>
</html>
