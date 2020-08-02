<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
$link = mysqli_connect('localhost', 'root', 'root', 'imgtest') or die (mysqli_connect_error($link));
mysqli_set_charset($link, "utf8");
// файл
header("Content-type: image/jpg");
if (isset($_GET['name']) AND isset($_GET['src'])){
  $data = $_GET['name'];
  $src_img =  $_GET['src'];
};
$filename = "gallery/img-$src_img.jpg";

$sql = "SELECT width FROM imgsize WHERE name = '".$data."'";
$result = mysqli_query($link, $sql) or die(mysqli_error($link));
$resultArray = mysqli_fetch_all($result);
$width =  $resultArray[0][0];
$sql = "SELECT height FROM imgsize WHERE name = '".$data."'";
$result = mysqli_query($link, $sql) or die(mysqli_error($link));
$resultArray = mysqli_fetch_all($result);
$height =  $resultArray[0][0];

list($width_orig, $height_orig) = getimagesize($filename);

// ресэмплирование
$image_p = imagecreatetruecolor($width, $height);
$image = imagecreatefromjpeg($filename);

imagecopyresampled($image_p, $image, 0, 0, 0, 0, $width, $height, $width_orig, $height_orig);
// вывод
imagejpeg($image_p, "cashe/img-$src_img.jpg");
imagejpeg($image_p, null, 100);

imagedestroy($image_p);

?>
