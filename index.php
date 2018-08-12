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
<?php require "svg-logo.php"; ?>
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