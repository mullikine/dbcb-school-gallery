<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<?php
$dir ='gallery-images';
$files = array_filter(scandir($dir), function($item) {
    return !is_dir($item) && !preg_match("/.txt$/", $item);
});

//print_r($files);

natcasesort($files);
//print_r($files);

$file_counts = array();

foreach($files as $f) {
    $first_letter = lcfirst($f[0]);
    if (array_key_exists($first_letter, $file_counts)) {
        $file_counts[$first_letter]++;
    } else {
        $file_counts[$first_letter] = 1;
    }
}
?>

<head>
<meta content="en-us" http-equiv="Content-Language" />
<meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
<title>A</title>
<link href="Style.css" rel="stylesheet" type="text/css" />
</head>
<body>
<div id="top"><!-- <a accesskey="g" nohref="nohref">i</a> --></div>
<div id="content">
<!-- viewBox="0 0 84.3 33.5" -->
<div id="toitu-logo">
<svg class="icon icon-logo-text" viewBox="0 0 84.3 33.5">
             <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#icon-logo_text"></use>
<g id="icon-logo_text">
  <path d="M26.1,8.8c-3.5,0-6.5,1.2-8.9,3.6c-2.4,2.4-3.6,5.3-3.6,8.6c0,3.4,1.2,6.2,3.6,8.7c2.4,2.4,5.3,3.6,8.9,3.6c3.5,0,6.4-1.2,8.7-3.6c2.3-2.4,3.5-5.3,3.5-8.7c0-3.5-1.1-6.4-3.4-8.7C32.5,10,29.6,8.8,26.1,8.8z M33.8,21c-0.2-0.6-0.7-1.2-1.4-1.9c-0.7-0.7-1.5-1.3-2.6-1.6c-1.3-0.5-2.7-0.4-4.1,0.4v4.3c1.2-0.7,2.3-0.7,3.3-0.1c1.1,0.7,1.6,1.6,1.5,2.9c0,1.1-0.5,2-1.5,2.7c-1,0.7-2,1-3.1,1c-2,0-3.7-0.7-5.2-2c-1.5-1.3-2.4-3.2-2.4-5.8c0-2.3,0.8-4.2,2.3-5.5c1.5-1.3,3.2-2.1,5.2-2.1c1.7,0,4.7,0.1,6.9,3.6C34.1,18.8,33.8,21,33.8,21z"></path>
  <path d="M8.4,0.3h-5v9H0.6v4.2h2.7v12c0,2.7,0.8,4.7,2.5,6c1.7,1.2,4,1.7,6.8,1.4v-4.6c-1.4,0.1-2.4-0.1-3.2-0.6c-0.7-0.5-1.1-1.3-1.1-2.3V13.4h4.3V9.2H8.4V0.3z"></path>
  <rect x="40" y="0.3" width="5.1" height="5.7"></rect>
  <path d="M78.6,9.2v19c-1,0.3-2.2,0.5-3.9,0.5c-1.6,0-3.4-0.5-4.7-1.6c-1.3-1.1-2-2.6-2-4.6V9.6c0-5.3-2.7-7.7-8.2-7.1v4.2c1.3-0.1,2.2,0.1,2.6,0.5C62.8,7.8,63,8.5,63,9.6v12.8c0,3.4,1.1,6.1,3.4,8c2.3,1.9,5,2.9,8.3,2.9c2.8,0,5.7-0.6,8.9-1.7V9.2H78.6z"></path>
  <path d="M55.4,0.3h-5v9h-2.7v4.2h2.7v12c0,2.7,0.8,4.7,2.5,6c1.7,1.2,4,1.7,6.8,1.4v-4.6c-1.4,0.1-2.4-0.1-3.2-0.6c-0.7-0.5-1.1-1.3-1.1-2.3V13.4h4.3V9.2h-4.3V0.3z"></path>
          <rect x="40.1" y="9.1" width="5" height="23.6"></rect>
          <rect x="70.4" y="0.4" width="6.4" height="3.4"></rect>
        </g>
         </svg>
</div>

<div id="header"></div>
       <div>
<?php
     function sum($carry, $item)
     {
         $carry += $item;
         return $carry;
     }

echo array_reduce($file_counts, "sum")." items on display"; ?>
</div>
<h2>Index</h2>
<!-- <h2 style="display:inline-block">Index</h2> -->

<ul id="index">
<?php
foreach(range('a','z') as $v){
  if (array_key_exists($v, $file_counts) && $file_counts[$v] > 0) {
    $disabled = false;
  } else {
    $disabled = true;
  }

  if ($disabled) {
      echo '<li class="disabled"><a nohref="nohref">', ucfirst($v), '</a></li>';
  } else {
    echo '<li class="active"><a href="#', $v, '">', ucfirst($v), '</a></li>';
  }
}
?>
</ul>

<?php

function remove_extension($fp) {
  return preg_replace('/\.[^.]+$/', '',  $fp);
}

function file_get_contents_utf8($fn) {
    $content = file_get_contents($fn);
    return mb_convert_encoding($content, 'UTF-8', mb_detect_encoding($content, 'UTF-8, ISO-8859-1', true));
    //return mb_convert_encoding($content, 'HTML-ENTITIES', "UTF-8");
}

$current_letter = NULL;

foreach($files as $f) {
  $first_letter = lcfirst($f[0]);
  if ($first_letter != $current_letter) {
    echo '<h2 id="', $first_letter, '">', ucfirst($first_letter), '</h2>';
    $current_letter = $first_letter;
  }
  echo '<h3>'.remove_extension($f).'</h3>';
  echo '<div class="gallery-item">';
  echo '<div class="image-holder">';
  echo '<img class="gallery-image" src="gallery-images/'.$f.'" />';
  echo '<div class="click-to-go-to-image-page">Click to go to image page</div>';
  echo '</div>';
  $description_file="gallery-images/".remove_extension($f).".txt";
  if (file_exists($description_file)) {
    echo '<p class="description">'.file_get_contents_utf8($description_file).'</p>';
  }
  echo '</div>'; /* gallery item */
}
?>
</div>
<!-- &#x25B2; -->
<div class="embossed" id="gototop"><a href="#top">&#x25B2; Return to Top</a></div>
<footer>
<div id="web-design">
<span class="rainbow-text">Web design</span> by SZ.
<div>
</footer>

</body>
</html>