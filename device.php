<?php
class Device {
  public static function isMobileDevice($httpUserAgent) {
      $mobileAgentArray = ['ipad',
      'iphone',
      'android',
      'pocket',
      'palm',
      'windows ce',
      'windowsce',
      'cellphone',
      'opera mobi',
      'ipod',
      'small',
      'sharp',
      'sonyericsson',
      'symbian',
      'opera mini',
      'nokia',
      'htc_',
      'samsung',
      'motorola',
      'smartphone',
      'blackberry',
      'playstation portable',
      'tablet browser'];
      $agent = strtolower($httpUserAgent);
      foreach ($mobileAgentArray as $value) {
          if (strpos($agent, $value) !== false) return true;
      }
      return false;
  }
}
