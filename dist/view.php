<?php include('layout/header.php'); ?>

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

<?php include('layout/footer.php'); ?>
