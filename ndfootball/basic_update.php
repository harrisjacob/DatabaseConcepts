<?php
session_start();
?>

<html>
<head>
<title>Update</title>
<link rel="stylesheet" href="styles.css">
<link rel="shortcut icon" href="ND_monogram_black_L.png"/>
</head>

<body>
<p><a href="index.php">To Homepage</a></p>
<?php
    $team = $_GET["team"];
    $update_name = $_GET["update_name"];
    $update_select = $_GET["update_select"];
    $update_data = $_GET["update_data"];
?>

<p>

<?php
  $link = mysqli_connect('localhost', 'mcoffey1', 'mcoffey1') or die ('could not connect');
  mysqli_select_db($link, 'mcoffey1') or die ('Could not select db');
  echo 'Successfully Connected';
  echo "\n";

  $update_sql = "update {$team} set {$update_select} = '{$update_data}' where Name like '{$update_name}'";
  if (is_numeric($update_select)){
	$update_sql = "update {$team} set {$update_select} = {$update_data} where Name like '{$update_name}'";
  }
  echo $update_sql;
  if($res = mysqli_query($link, $update_sql)){
	echo 'Success';
  }
  else {
	echo 'Failure';
  }

  $sql = "select * from {$team} where Name like '{$update_name}'";

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
 
// Close connection
mysqli_close($link);
?>

