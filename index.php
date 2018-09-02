<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta content="en-us" http-equiv="Content-Language" />
<meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
<title>A</title>
<link href="Style.css" rel="stylesheet" type="text/css" />
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="js/script.js" type="text/javascript"></script>
</head>
<body>
<div id="top"><!-- <a accesskey="g" nohref="nohref">i</a> --></div>
<div id="content">
<!-- viewBox="0 0 84.3 33.5" -->
<div id="toitu-logo">
<?php require "svg-logo.php"; ?>
</div>

<div id="header">
    <form action="javascript:void(0);" method="get" id="search">
    	<input id="bob" name="bob" value="Search..." />
        <input style="display:none" type="submit" id="submitbtn" value="Search"/>
    </form>
</div>

<div class="alphabet noselect">
<h2 class="ib noselect">Keyboard</h2>
<!-- <h2 style="display:inline-block">Index</h2> -->

<ul id="keyboard">
<?php
foreach(range('a','z') as $v){
  echo '<li class="active"><a id="key_'.$v.'" nohref="nohref" class="keyboard_key noselect">', ucfirst($v), '</a></li>';
}
?>
<li class="active"><a id="backspace" nohref="nohref" class="keyboard_key noselect">&#x232B;</a></li>
</ul>
</div>

<!-- <br style="break:both;" /> -->

<div id="results">
<?php include("search.php"); ?>
</div>
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