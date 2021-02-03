<?php

$image = imagecreatefromjpeg('image.jpg');
$image_size = getimagesize('image.jpg');

$logo = imagecreatefrompng('logo.png');
$logo_size = getimagesize('logo.png');

$x = $image_size[0] - $logo_size[0] - 20;
$y = $image_size[1] - $logo_size[1] - 20;

imagecopy($image, $logo, $x, $y, 0, 0, $logo_size[0], $logo_size[1]);

header('Content-Type: image/jpeg');
imagejpeg($image);