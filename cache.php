<?php

class ImageCache {
//cache каталог
CONST PATH = 'cache/';

  public function setCache($name, $image) {
    imagejpeg($image, self::PATH . $name .".jpg" );
  }

  public static function getCache($name) {
    if ($name==true) {
    return true;
    }
    else {
      return false;
    }
  }
}
