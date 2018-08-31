<?php

//print_r($_GET);

$query = $_GET['bob'];

$dir ='gallery-images';
$reg = '/'.$query.'/i';

$files = array_filter(scandir($dir), function($item) {
    // print_r($reg.$_GET['bob'].$item);
    return !is_dir($item) && preg_match("/.jpg$/", $item) && ( strlen($_GET['bob']) == 0 || preg_match("/" . $_GET['bob']. "./i", $item) );
});

// print_r($files);

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


<div class="alphabet">
<h2 class="ib">A-Z</h2>
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
</div>



<?php
       function sum($carry, $item)
       {
           $carry += $item;
           return $carry;
       }

$s = array_reduce($file_counts, "sum");
if ($s > 0) {
echo "<div id=\"results-summary\">";
echo $s." items on display";
echo "</div>";
}
?>

<div id="exhibits">

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
    echo '<h2 class="alpha" id="', $first_letter, '">', ucfirst($first_letter), '</h2>';
    $current_letter = $first_letter;
  }
  echo '<div id="exhibit">';
  echo '<h3 id="exhibit-name">'.remove_extension($f).'</h3>';
  echo '<div class="gallery-item">';
  echo '<div class="image-holder">';
  echo '<img class="gallery-image" src="gallery-images/'.$f.'" />';
  echo '<div class="click-to-go-to-image-page">Click to go to image page</div>';
  echo '</div>';
  $description_file="gallery-images/".remove_extension($f).".txt";
  if (file_exists($description_file)) {
    echo '<p class="description">'.file_get_contents_utf8($description_file).'</p>';
  }
  $data_file="gallery-images/".remove_extension($f).".csv";
  if (file_exists($data_file)) {

    echo '<code>';
    // print_r(file($data_file));
    print("<pre>".print_r(file($data_file),true)."</pre>");
    echo '</code>';
    #$data = str_getcsv(file($data_file), "\n"); //parse the rows
    #print_r($data);

    #echo '<br>';
    #echo '<br>';
    #echo '<br>';

    echo '
    <table class="image-data">
      <tr>
      <td>Measurements</td><td>1220x690x670mm</td>
      </tr>
      </table>
';


    echo '<table id="image-data">';
    foreach($a as $k => $v) {
      echo '<tr>';
      echo '<td>'.$k.'</td>'.'<td>'.$v.'</td>';
      echo '</tr>';
    }
    echo '</table>';
  }
  echo '</div>'; /* gallery item */
  echo '</div>'; /* exhibit */
}
?>
</div> <!-- exhibits -->