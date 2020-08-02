<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <script type="text/javascript" src="dist/js/chocolat.js"></script>
  <link rel="stylesheet" href="dist/css/chocolat.css" type="text/css" media="screen" >
  <title>Document</title>
</head>
<?php
function check_mobile_device() {
    $mobile_agent_array = array('ipad', 'iphone', 'android', 'pocket', 'palm', 'windows ce', 'windowsce', 'cellphone', 'opera mobi', 'ipod', 'small', 'sharp', 'sonyericsson', 'symbian', 'opera mini', 'nokia', 'htc_', 'samsung', 'motorola', 'smartphone', 'blackberry', 'playstation portable', 'tablet browser');
    $agent = strtolower($_SERVER['HTTP_USER_AGENT']);
    foreach ($mobile_agent_array as $value) {
        if (strpos($agent, $value) !== false) return true;
    }
    return false;
}
$is_mobile_device = check_mobile_device();
if($is_mobile_device){
    $name= "mic";
    $full_img = "med";
}else{
    $name= "min";
    $full_img = "big";
  }
?>
<body>

<div class="chocolat-parent">

  <?php  for ($x=1; $x<11; $x++) { ?>
    <a class="chocolat-image" href="generator.php?size=<?=$full_img?>&name=<?=$x?>" title="caption image 1">
      <img src="generator.php?size=<?=$name?>&name=<?=$x?>" alt="">
    </a>
  <?php } ?>
</div>
<script>
document.addEventListener("DOMContentLoaded", function(event) {
    Chocolat(document.querySelectorAll('.chocolat-parent .chocolat-image'))
})</script>
</body>
</html>
