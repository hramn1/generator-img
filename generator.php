<?php
require_once 'init.php';
require_once 'cache.php';
error_reporting(E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
$dbHelper = new Database(...$db_cfg);
$imgCache = new ImageCache;
if ($dbHelper->getLastError()) {
	show_error($content, $dbHelper->getLastError());
} else {
  header("Content-type: image/jpg");
  if (isset($_GET['size']) AND isset($_GET['name'])){
    $data = [$_GET['size']];
    $src_img =  $_GET['name'];
    $full_name = $_GET['size'].$_GET['name'];
  } else {
    $data = ['big'];
    $src_img = "3";
    $full_name = "big3";
    }
    $filenameCache = "img-$full_name";
    if ($imgCache->getCache($filenameCache)==false){
      $filename = "gallery/img-$src_img.jpg";
      $dbHelper->executeQuery('SELECT width FROM imgsize WHERE name = ?', $data);
      $rowWidth = $dbHelper->getResultAsArray();
      $dbHelper->executeQuery('SELECT height FROM imgsize WHERE name = ?', $data);
      $rowHeight = $dbHelper->getResultAsArray();
      $width =  $rowWidth[0]['width'];
      $height = $rowHeight[0]['height'];
      //
      list($width_orig, $height_orig) = getimagesize($filename);
      //
      // // ресэмплирование
      $image_p = imagecreatetruecolor($width, $height);
      $image = imagecreatefromjpeg($filename);
      //
      imagecopyresampled($image_p, $image, 0, 0, 0, 0, $width, $height, $width_orig, $height_orig);
      // // вывод
      imagejpeg($image_p, null, 100);
      $imgCache->setCache($filenameCache,$image_p);
      //
      imagedestroy($image_p);
}

}


?>
