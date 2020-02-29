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
<div class='tab'>
<a id='to_homepage' href="index.php"><<< Back To Homepage</a>
</div>
<?php
  $team = $_GET["team"];
  $query_key = $_GET["play_query"];
  $gain = $_GET["gain_amount"];
?>
<div id='result_page_output'>
<br>
You are looking for play name <?=$query_key?> during the <?=$team?> game.


<p>
<?php
  $link = mysqli_connect('localhost', 'mcoffey1', 'mcoffey1') or die ('could not connect');
  mysqli_select_db($link, 'mcoffey1') or die ('Could not select db');
  echo '<div id=\'sc\'>Successfully Connected</div>';
  echo "\n";

/*
$inputstring = "SELECT Series FROM UGA"; 
  $stmt = mysqli_prepare($link, $inputstring)
    mysqli_stmt_bind_param($stmt, "s", $_GET["play_query"];
    if(mysqli_stmt_bind_result($stmt, $result)){
      echo "bound right";
    }
    
    mysqli_stmt_execute($stmt);
    echo "mysqli_num_fields($result)";
    $res = mysqli_stmt_result_metadata($stmt);
    echo mysqli_num_rows($res);  
    echo mysqli_fetch_fields($res);
  
    while($row = mysqli_fetch_array($result)){
    echo "ghg"; 
    }

    mysqli_stmt_close();
*/

$sql = "select * from {$team}, GAMES where {$team}.Name like '{$query_key}' and {$team}.Game = GAMES.Game_Name";
//if($stmt = mysqli_prepare($link, $sql)){
  if($result = mysqli_query($link, $sql)){
    if(mysqli_num_rows($result) > 0){
		$headers = ["Game","Name","Obvious Play", "Situation", "Drive-Starting Event", "Series", "Quarter", "Clock", "Score", "Down", "Dist", "Field Position", "Hash", "RorP", "Result", "Gain", "Explosive", "Personnel", "Formation", "Coverage", "Middle of Field Open Safeties", "Play", "Backfield", "Blitz", "LB Box", "Front", "Motion Shift"];
//		echo "<table class='query_table'>";
//            echo "<tr>";
//                echo "<th>Name</th>";
//                echo "<th>Game</th>";
//                echo "<th>ObviousPlay</th>";
//                echo "<th>Situation</th>";
//				echo "<th>pff_DRIVESTARTEVENT</th>";
//				echo "<th>Series</th>";
//				echo "<th>Quarter</th>";
//				echo "<th>pff_CLOCK</th>";
//				echo "<th>pff_SCORE</th>";
//				echo "<th>Down</th>";
//				echo "<th>Dist</th>";
//				echo "<th>FieldPos</th>";
//				echo "<th>Hash</th>";
//				echo "<th>RorP</th>";
//				echo "<th>Result</th>";
//				echo "<th>Gain</th>";
//				echo "<th>Explosive</th>";
//				echo "<th>Personnel</th>";
//				echo "<th>Formation</th>";
//				echo "<th>Coverage</th>";
//				echo "<th>MOFO_Safeties</th>";
//				echo "<th>Play</th>";
//				echo "<th>Backfield</th>";
//				echo "<th>LBBox</th>";
//				echo "<th>Front</th>";
//				echo "<th>Motion_Shift</th>";
//            echo "</tr>";
        while($row = mysqli_fetch_array($result)){
//            echo "<tr>";
//                echo "<td>" . $row[1] . "</td>";
//                echo "<td>" . $row[0] . "</td>";
//				for ($i = 2; $i < 26; $i++){
//	                echo "<td>" . $row[$i] . "</td>";
//				}
//			echo "</tr>";
//        	echo "</table>";

			//echo "<table><tbody>";
			for ($i = 0; $i < 27; $i++){
				//echo "<tr><th>" . $headers[$i] . "</th>";
				//echo "<td>" . $row[$i] . "</td></tr>";
				echo "<br><span class='query_in'>" . $headers[$i] . ":</span>";
				echo " <span class='query_out'>" . $row[$i] . "</span>"; 
				
			}
			echo "<br><span class='query_in'>2019 Week: </span>";
			echo "<span class='query_out'>" . $row[29] . "</span>";
			//echo "</tbody></table>";
		}
        mysqli_free_result($result);
    } else{
        echo "No matching records were found.";
    }
} else{
    echo "ERROR: Not able to execute $sql. " . mysqli_error($link);
}

echo "<p class='query_in'>";
 if($gain < 200){
  echo "Plays where minimum gain is $gain";
  $sql = "select Name from {$team} where Gain >= {$gain}";
  if($result = mysqli_query($link, $sql)){
   while($row = mysqli_fetch_array($result)){
     for($i=0; $i < mysqli_field_count($link); $i++){
       echo "<pre><br> $row[$i]</pre>";
     }
   }
}
mysqli_free_result($result);
}
echo "</p>";
     
   
// Close connection

mysqli_close($link);
?>

</div>
