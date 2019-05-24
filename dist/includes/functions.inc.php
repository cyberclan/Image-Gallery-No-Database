<?php

// errorsTexts
$errorViewImagesText = 'Something Went Wrong';

// templates
$errorViewImages = "<h3 class='text-center'>{$errorViewImagesText}</h3>";

// functions

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
	// imagecopyresampled(dst_img, src_img, dst_x, dst_y, src_x, src_y, dst_w, dst_h, src_w, src_h)
	imagecopyresampled($tci, $img, 0, 0, 0, 0, $w, $h, $w_orig, $h_orig);
	imagejpeg($tci, $newcopy, 80);
}

?>