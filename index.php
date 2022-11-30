<?php

$file = file_get_contents('./html.txt', true);

$newPrice = preg_match_all('#<title>(.+?)</title>|<meta name="keywords" content=(.+?)>|<meta name="description" content=(.+?)>#is', $file, $arr);

foreach($arr as $each => $el)
{
  if(!empty($each))
  {
    $t = array_filter(array_values($el));
    $saFindItems = implode('', array_reverse($t));
    echo preg_replace('/"+/', '', $saFindItems) . "<br>";
  }
}
?>