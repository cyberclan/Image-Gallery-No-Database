<?php

// errorsTexts
$errorViewImagesText = 'Something Went Wrong';

// templates
$errorViewImages = "<h3 class='text-center'>{$errorViewImagesText}</h3>";

// functions

// view Images
function viewImages($getImages) {
	$extractImage = explode('_', htmlspecialchars($getImages));
	$image = end($extractImage);

	return '<img class="w-100" src="uploads/images/'.$image.'" alt="">';
}

?>