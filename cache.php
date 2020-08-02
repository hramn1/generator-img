<?php

class ImageCache {

  CONST PATH = 'cache/';

  public static function setCache($name, $image) {
    imagejpeg($image, self::PATH . $name .".jpg" );
  }

  public static function getCache($name){
  		$fullPath = self::PATH . $name .".jpg";
  		header('Content-Type: image/jpeg');
  		readfile($fullPath);
	}

  public static function hasCache($name){
    $fullPath = self::PATH . $name .".jpg";

    if (!file_exists($fullPath)){
        return false;
    }

    return true;
  }
}
