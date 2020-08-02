<?php
require_once 'init.php';
require_once 'cache.php';
error_reporting(E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
$dbHelper = new Database(...$db_cfg);

try {
	if ($dbHelper->getLastError()) {
		throw new \Exception($dbHelper->getLastError(), 1);
	}
	if (!isset($_GET['size']) OR !isset($_GET['name'])){
		http_response_code(400);
	  throw new \Exception("Bad Request", 1);
	}
	$name = strip_tags($_GET['name']);
	$size = strip_tags($_GET['size']);

	$fullName = $size.$name;
	$filenameCache = "img-$fullName";

	$dbHelper->executeQuery('SELECT width, height FROM imgsize WHERE name = ?', [$size]);
	$result = $dbHelper->getOneResultAsArray();
	if($result===NULL){
		throw new \Exception("Size not found", 1);
	}

	if (ImageCache::hasCache($filenameCache)==false){
	  $filename = "gallery/img-$name.jpg";

  	list($width_orig, $height_orig) = getimagesize($filename);

	  $image_p = imagecreatetruecolor( $result['width'], $result['height']);
	  $image = imagecreatefromjpeg($filename);
	  imagecopyresampled($image_p, $image, 0, 0, 0, 0, $result['width'], $result['height'], $width_orig, $height_orig);

  	header('Content-Type: image/jpeg');

	  imagejpeg($image_p, null, 100);
	  ImageCache::setCache($filenameCache,$image_p);

	  imagedestroy($image_p);
	} else {
		ImageCache::getCache($filenameCache);
	}
} catch(\Exception $e) {
		echo $e->getMessage();
	}
