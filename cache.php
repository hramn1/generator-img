<?php

class ImageCache {
//cache каталог
CONST PATH = 'cache/';

  public function setCache($name, $image) {
    imagejpeg($image, self::PATH . $name .".jpg" );
  }

  public static function getCache($name)
  	{
  		$fullPath = self::PATH . $name .".jpg";

  		if (!file_exists($fullPath)){
   	  		return false;
  		}

  		$type = 'image/jpeg';

  		header('Content-Type:'.$type);

  		header('Content-Length: ' . filesize($fullPath));

  		readfile($fullPath);
  	}
}
