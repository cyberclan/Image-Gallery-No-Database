<?php

// errorsTexts
$errorViewImagesText = 'Something Went Wrong';

// templates
$errorViewImages = "<h3 class='text-center'>{$errorViewImagesText}</h3>";

// All functions

// function for viewing Images
function viewImages($getImages) {
	$extractImage = explode('_', htmlspecialchars($getImages));
	$image = end($extractImage);

	return '<img class="w-100" src="uploads/images/'.$image.'" alt="">';
}

// function for resizing jpg, gif, or png image files
function generateThumbnail($target, $newcopy, $w, $h, $ext) {
	list($w_orig, $h_orig) = getimagesize($target);
	$scale_ratio = $w_orig / $h_orig;
	if (($w / $h) > $scale_ratio) {
		$w = $h * $scale_ratio;
	} else {
		$h = $w / $scale_ratio;
	}
	$img = "";
	$ext = strtolower($ext);
	if ($ext == "gif"){
		$img = imagecreatefromgif($target);
	} else if($ext =="png"){
		$img = imagecreatefrompng($target);
	} else {
		$img = imagecreatefromjpeg($target);
	}
	$tci = imagecreatetruecolor($w, $h);
	
	imagecopyresampled($tci, $img, 0, 0, 0, 0, $w, $h, $w_orig, $h_orig);
	imagejpeg($tci, $newcopy, 80);
}

// function for setting location of header
function setLocationHeader($param = "") {
	$locationString = "";
	if(empty($param)) {
		$locationString = "Location: ../index.php";
	} else {
		$locationString = "Location: ../index.php?upload={$param}";
	}
	header($locationString);
	exit();
}

// function for uploading images
function uploadingImages() {
	if (isset($_POST['upload'])) {
		if (empty($_FILES['file']['name'])) {
			setLocationHeader("empty");
		} else {

			// variables for uploading images
			$imageName = $_FILES['file']['name'];
			$imageTmpName = $_FILES['file']['tmp_name'];
			$imageError = $_FILES['file']['error'];
			$imageSize = $_FILES['file']['size'];

			$extractExt = explode('.', $imageName);
			$imageExt = strtolower(end($extractExt));
			$allowed = array("jpeg", "jpg", "png");

			$imageNewName = uniqid('', true).".".$imageExt;
			$imageDestination = "../uploads/images/".$imageNewName;

			$target_file = "../uploads/images/{$imageNewName}";
			$resized_file = "../uploads/thumb/thumb_{$imageNewName}";
			$wmax = 350;
			$hmax = 300;

			if (!in_array($imageExt, $allowed)) {
				setLocationHeader("not-allowed");
			} else {
				if ($imageError > 0) {
					setLocationHeader("error");
				} else if ($imageError === 0) {
					if ($imageSize <= 2097152 === false) {
						setLocationHeader("big-file-size");
					} else {

						move_uploaded_file($imageTmpName, $imageDestination);
						// ---------- Include Universal Image Resizing Function --------
						generateThumbnail($target_file, $resized_file, $wmax, $hmax, $imageExt);
						// ----------- End Universal Image Resizing Function -----------
						setLocationHeader("success");
					}
				}
			}
		}
	} else {
		setLocationHeader();
	}
}



?>