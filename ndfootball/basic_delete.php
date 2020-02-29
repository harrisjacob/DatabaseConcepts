<?php
session_start();
?>

<html>
<head>
<title>Result of Query</title>
<link rel="stylesheet" href="styles.css">
<link rel="shortcut icon" href="ND_monogram_black_L.png"/>
</head>

<body>
</p><a href="index.php">Return to homepage</a></p>
<?php
  $team = $_GET["team"];
  $query_key = $_GET["play_query"];
?>
You are trying to delete play name <?=$query_key?> during the <?=$team?> game


<p>

<?php
  $link = mysqli_connect('localhost', 'mcoffey1', 'mcoffey1') or die ('could not connect');
  mysqli_select_db($link, 'mcoffey1') or die ('Could not select db');
  echo '<div id=\'sc\'>Successfully Connected</div>';

  $sql = "delete from {$team} where Name like '{$query_key}'";

  if($result = mysqli_query($link, $sql)){
	echo " Success! Entry deleted";
} else{
    echo "ERROR: Not able to execute $sql. " . mysqli_error($link);
}
 
// Close connection
mysqli_close($link);
?>

