<?php include('functions.inc.php'); ?>

<?php
	if (isset($_POST['upload'])) {
		if (empty($_FILES['file']['name'])) {
			header('Location: ../index.php?upload=empty');
			exit();
		} else {
			$imageName = $_FILES['file']['name'];
			$imageTmpName = $_FILES['file']['tmp_name'];
			$imageError = $_FILES['file']['error'];
			$imageSize = $_FILES['file']['size'];

			$extractExt = explode('.', $imageName);
			$imageExt = strtolower(end($extractExt));
			$allowed = array("jpeg", "jpg", "png");

			if (!in_array($imageExt, $allowed)) {
				header('Location: ../index.php?upload=not-allowed');
				exit();
			} else {
				if ($imageError > 0) {
					header('Location: ../index.php?upload=error');
					exit();
				} else if ($imageError === 0) {
					if ($imageSize <= 2097152 === false) {
						header('Location: ../index.php?upload=big-file-size');
						exit();
					} else {
						$imageNewName = uniqid('', true).".".$imageExt;
						$imageDestination = "../uploads/images/".$imageNewName;

						move_uploaded_file($imageTmpName, $imageDestination);

						// ---------- Include Universal Image Resizing Function --------
						//include_once("resize.inc.php");
						$target_file = "../uploads/images/$imageNewName";
						$resized_file = "../uploads/thumb/thumb_$imageNewName";
						$wmax = 350;
						$hmax = 300;
						generateThumbnail($target_file, $resized_file, $wmax, $hmax, $imageExt);
						// ----------- End Universal Image Resizing Function -----------

						header('Location: ../index.php?upload=success');
						exit();
					}
				}
			}
		}
	} else {
		header('Location: ../index.php');
		exit();
	}