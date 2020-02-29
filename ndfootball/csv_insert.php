<?php
session_start();
?>

<html>
<head>
<title>CSV insert</title>
<link rel="stylesheet" href="styles.css">
<link rel="shortcut icon" href="ND_monogram_black_L.png"/>
</head>

<body>
<div class='tab'>
<a id="to_homepage" href="index.php"><<< Back to Homepage</a>
</div>
<br>

<?php
  $opponent = $_GET["opponent"];
  $csv_file = $_GET["csv_file"];
?>


<?php
 echo "You have inserted game {$opponent}";

  $link = mysqli_connect('localhost', 'mcoffey1', 'mcoffey1') or die ('could not connect');
  mysqli_select_db($link, 'mcoffey1') or die ('Could not select db');
  echo 'Successfully Connected';
  echo "\n";

  $sql = "CREATE TABLE if not exists {$opponent} LIKE UGA";
  if($result = mysqli_query($link, $sql)){
    echo "Table created correctly";
  }
  else{
    echo "Unable to create table, check that the name doesn't already exist";
  }
  mysqli_free_result($result);
  
  $sql2 = "LOAD DATA LOCAL INFILE \"{$csv_file}\" INTO TABLE {$opponent} FIELDS TERMINATED BY ',' LINES TERMINATED BY '\n' IGNORE 1 ROWS";
  if($result = mysqli_query($link, $sql2)){
    echo "Data loaded into table {$opponent} .";
  }
  else{
    echo "Unable to load data into table";
  }
  mysqli_free_result($result);   
  
  $sql3 = "SELECT * FROM {$opponent} limit 5";
  

  if($result = mysqli_query($link, $sql3)){
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
</body>
</html>

