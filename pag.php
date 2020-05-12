<!doctype html>
<!--
  mircea
  list all attacks and filter
-->
<html lang="en">
<head>
<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="stylesheet" type="text/css" href="pag.css">
  <title>Attacks list</title>
</head>
<body>
<form method="post" action="index.php">
    <button type="submit">Back to the map</button>
</form>
  <?php
include 'DBAcess.php';
  ?>
<form method="post" action="" name="form">  
<label>Country:</label>

<select name="country">
<?php
include 'valCountry.php';
?>
</select>
<label>Year:</label>
<select name="year">
<?php
include 'valYear.php';
?>
</select>
<label>Weapon:</label>
<select name="weapon">
<?php
include 'valWeapon.php';
?>
</select>
<label>Page:</label>
<select name="pages">
<?php
include 'nrpagcont.php';
?>
</select>
<input name="submit" type="submit" value="Submit">
</form>
    <ol id="lista" style="position:relative; left: 200px">
    <?php
    include "filter.php";
    ?></ol>
      </body>
      </html>