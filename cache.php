<?php

class ImageCache
{
//cache каталог
CONST PATH = 'cache/';

public function setCache($name, $image)
{
imagejpeg($image_p, self::PATH . $name ."jpg" );
}

public static function getCache($name) {
if ($name) {
  //чтение их файла
  imagejpeg($image_p, null, 100);
  }
  else {
    return false;
  }
}

}
