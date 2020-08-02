<?php require_once 'device.php'; ?>

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
if(Device::isMobileDevice($_SERVER['HTTP_USER_AGENT'])){
    $name = "mic";
    $full_img = "med";
    $med_img = "min";
}else{
    $name= "min";
    $med_img = "med";
    $full_img = "big";
  }
?>
<body>

<div class="chocolat-parent">

  <?php  for ($x=1; $x<11; $x++) { ?>
    <a class="chocolat-image" href="generator.php?size=<?=$full_img?>&name=<?=$x?>" data-min="generator.php?size=<?=$name?>&name=<?=$x?>"
      data-med ="generator.php?size=<?=$med_img?>&name=<?=$x?>"
       title="caption image 1">
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
