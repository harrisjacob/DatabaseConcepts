<?php
session_start();
?>

<html>
<head>
<title>Result of basic insert</title>
<link rel="stylesheet" href="styles.css">
<link rel="shortcut icon" href="ND_monogram_black_L.png"/>
</head>

<body>
<div class='tab'><a id='to_homepage' href="index.php"><<< Back to Homepage</a></div>
<?php
    $team = $_GET["team"];
	echo $_GET["Name"];
echo $_GET["Number"];
echo $_GET["ObviousPlay"];
echo $_GET["Situation"];
echo $_GET["pff_DRIVESTARTEVENT"];
echo $_GET["Series"];
echo $_GET["Quarter"];
echo $_GET["pff_CLOCK"];
echo $_GET["pff_SCORE"];
echo $_GET["Down"];
echo $_GET["Dist"];
echo $_GET["FieldPos"];
echo $_GET["Hash"];
echo $_GET["RorP"];
echo $_GET["Result"];
echo $_GET["Gain"];
echo $_GET["Explosive"];
echo $_GET["Personnel"];
echo $_GET["Formation"];
echo $_GET["Coverage"];
echo $_GET["MOFO_Safeties"];
echo $_GET["Play"];
echo $_GET["Backfield"];
echo $_GET["LBBox"];
echo $_GET["Front"];
echo $_GET["Motion_Shift"];

?>
<!--
You are looking for play name <?=$query_key?> during the <?=$team?> game
--!>

<p>

<?php
  $link = mysqli_connect('localhost', 'mcoffey1', 'mcoffey1') or die ('could not connect');
  mysqli_select_db($link, 'mcoffey1') or die ('Could not select db');
  echo '<div id=\'sc\'>Successfully Connected</div>';
  echo "\n";

  $insert_sql = "insert into {$team} values ({$_GET["Number"]},\"{$_GET["Name"]}\",\"{$_GET["ObviousPlay"]}\",{$_GET["Situation"]},\"{$_GET["pff_DRIVESTARTEVENT"]}\",{$_GET["Series"]},{$_GET["Quarter"]},\"{$_GET["pff_CLOCK"]}\",{$_GET["pff_SCORE"]},{$_GET["Down"]},{$_GET["Dist"]},{$_GET["FieldPos"]},\"{$_GET["Hash"]}\",\"{$_GET["RorP"]}\",\"{$_GET["Result"]}\",{$_GET["Gain"]},\"{$_GET["Explosive"]}\",{$_GET["Personnel"]},\"{$_GET["Formation"]}\",\"{$_GET["Coverage"]}\",\"{$_GET["MOFO_Safeties"]}\",\"{$_GET["Play"]}\",\"{$_GET["Backfield"]}\",\"{$_GET["LBBox"]}\",\"{$_GET["Front"]}\",\"{$_GET["Motion_Shift"]}\")";
  echo $insert_sql;
  if($res = mysqli_query($link, $insert_sql)){
	echo 'Success';
  }
  else {
	echo 'Failure';
  }
/*
  $sql = "select * from {$team} where Name like '{$_GET["Name"]}'";

  if($result = mysqli_query($link, $sql)){
    if(mysqli_num_rows($result) > 0){
		echo "<table>";
            echo "<tr>";
                echo "<th>Name</th>";
                echo "<th>Number</th>";
                echo "<th>ObviousPlay</th>";
                echo "<th>Situation</th>";
				echo "<th>pff_DRIVESTARTEVENT</th>";
				echo "<th>Series</th>";
				echo "<th>Quarter</th>";
				echo "<th>pff_CLOCK</th>";
				echo "<th>pff_SCORE</th>";
				echo "<th>Down</th>";
				echo "<th>Dist</th>";
				echo "<th>FieldPos</th>";
				echo "<th>Hash</th>";
				echo "<th>RorP</th>";
				echo "<th>Result</th>";
				echo "<th>Gain</th>";
				echo "<th>Explosive</th>";
				echo "<th>Personnel</th>";
				echo "<th>Formation</th>";
				echo "<th>Coverage</th>";
				echo "<th>MOFO_Safeties</th>";
				echo "<th>Play</th>";
				echo "<th>Backfield</th>";
				echo "<th>LBBox</th>";
				echo "<th>Front</th>";
				echo "<th>Motion_Shift</th>";
            echo "</tr>";
        while($row = mysqli_fetch_array($result)){
            echo "<tr>";
                echo "<td>" . $row[1] . "</td>";
                echo "<td>" . $row[0] . "</td>";
				for ($i = 2; $i < 26; $i++){
	                echo "<td>" . $row[$i] . "</td>";
				}
            echo "</tr>";
        }
        echo "</table>";
        mysqli_free_result($result);
    } else{
        echo "No matching records were found.";
    }

} else{
    echo "ERROR: Not able to execute $sql. " . mysqli_error($link);
}
*/
 
// Close connection
mysqli_close($link);
?>

