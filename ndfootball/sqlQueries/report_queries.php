<?php
session_start();
?>

<html>
<head>
<title>Report Queries</title>
<link rel="stylesheet" href="../styles.css">
<style>
* {
  box-sizing: border-box;
}
.column {
  float: left;
  width: 50%;
  padding: 10px;
  height: 1100px;
}

.row:after {
  content: "";
  display: table;
  clear: both;
}
h10 {
  font-weight: bold;
  font-size: 48px;
}


</style>
</head>

<body>
<a id='to_homepage' href="../index.php">To Homepage</a>

<?php
  $team = $_GET["team"];
?>

<p>
<?php
  $link = mysqli_connect('localhost', 'mcoffey1', 'mcoffey1') or die ('Failed to connect to database');
  echo "\n";
  mysqli_select_db($link, 'mcoffey1') or die ('Failed to Connect or Select Database');
  $team = mysqli_real_escape_string($link, $team);

?>
</p>


<h10><center><?=$team?> Report</center></h10>

<?php

        $covQuery = "SELECT Coverage, COUNT(Coverage) AS Snaps FROM ".$team." GROUP BY Coverage ORDER BY Snaps DESC LIMIT 10";

        $covResult = mysqli_query($link, $covQuery) or die('Query failed:'.mysql_error());


        $topBlitzQuery = "SELECT Blitz, (SELECT COUNT(*) FROM ".$team." WHERE Blitz != (SELECT Blitz FROM ".$team." GROUP BY Blitz ORDER BY COUNT(*) DESC LIMIT 1)) AS Total, COUNT(*) AS Frequency, COUNT(*)/(SELECT COUNT(*) FROM ".$team." WHERE Blitz != (SELECT Blitz FROM ".$team." GROUP BY Blitz ORDER BY COUNT(*) DESC LIMIT 1))*100 AS Percent FROM ".$team." WHERE Blitz != (SELECT Blitz FROM ".$team." GROUP BY Blitz ORDER BY COUNT(*) DESC LIMIT 1) GROUP BY Blitz ORDER BY Frequency DESC LIMIT 10;";

        $blitzResult = mysqli_query($link, $topBlitzQuery) or die('Query failed:'.mysql_error());



        $runDownQ = "SELECT Coverage, COUNT(Coverage) AS Snaps, (SELECT COUNT(*) FROM ".$team." WHERE Down = 1 OR (Down = 2 AND Dist <= 6)) AS TOTAL, COUNT(Coverage)/(SELECT COUNT(*) FROM ".$team." WHERE Down = 1 OR (Down = 2 AND Dist <= 6))*100 AS PERCENT FROM ".$team." WHERE Down = 1 OR (Down = 2 AND Dist <= 6) GROUP BY Coverage ORDER BY Snaps DESC LIMIT 1;";
        $secSevQ = "SELECT Coverage, COUNT(Coverage) AS Snaps, (SELECT COUNT(*) FROM ".$team." WHERE Down = 2 AND Dist > 6) AS TOTAL, COUNT(Coverage)/(SELECT COUNT(*) FROM ".$team." WHERE Down = 2 AND Dist > 6)*100 AS PERCENT FROM ".$team." WHERE Down = 2 AND Dist > 6 GROUP BY Coverage ORDER BY Snaps DESC LIMIT 1;";
        $thirdOneQ = "SELECT Coverage, COUNT(Coverage) AS Snaps, (SELECT COUNT(*) FROM ".$team." WHERE Down = 3 AND Dist =1) AS TOTAL, COUNT(Coverage)/(SELECT COUNT(*) FROM ".$team." WHERE Down = 3 AND Dist =1)*100 AS PERCENT FROM ".$team." WHERE Down = 3 AND Dist = 1 GROUP BY Coverage ORDER BY Snaps DESC LIMIT 1;";
        $thirdTwoQ = "SELECT Coverage, COUNT(Coverage) AS Snaps,(SELECT COUNT(*) FROM ".$team." WHERE Down = 3 AND Dist > 1 AND Dist < 4) AS TOTAL, COUNT(Coverage)/(SELECT COUNT(*) FROM ".$team." WHERE Down = 3 AND Dist > 1 AND Dist < 4)*100 AS PERCENT FROM ".$team." WHERE Down = 3 AND Dist < 4 AND Dist > 1 GROUP BY Coverage ORDER BY Snaps DESC LIMIT 1;";
        $thirdFourQ = "SELECT Coverage, COUNT(Coverage) AS Snaps,(SELECT COUNT(*) FROM ".$team." WHERE Down = 3 AND Dist > 3 AND Dist < 7) AS TOTAL, COUNT(Coverage)/(SELECT COUNT(*) FROM ".$team." WHERE Down = 3 AND Dist > 3 AND Dist < 7)*100 AS PERCENT FROM ".$team." WHERE Down = 3 AND Dist < 7 AND Dist > 3 GROUP BY Coverage ORDER BY Snaps DESC LIMIT 1;";
        $thirdSevenQ = "SELECT Coverage, COUNT(Coverage) AS Snaps,(SELECT COUNT(*) FROM ".$team." WHERE Down = 3 AND Dist > 6 AND Dist < 11) AS TOTAL, COUNT(Coverage)/(SELECT COUNT(*) FROM ".$team." WHERE Down = 3 AND Dist > 6 AND Dist < 11)*100 AS PERCENT FROM ".$team." WHERE Down = 3 AND Dist < 11 AND Dist > 6 GROUP BY Coverage ORDER BY Snaps DESC LIMIT 1;";
        $thirdElevenQ = "SELECT Coverage, COUNT(Coverage) AS Snaps,(SELECT COUNT(*) FROM ".$team." WHERE Down = 3 AND Dist > 10) AS TOTAL, COUNT(Coverage)/(SELECT COUNT(*) FROM ".$team." WHERE Down = 3 AND Dist > 10)*100 AS PERCENT FROM ".$team." WHERE Down = 3 AND Dist > 10 GROUP BY Coverage ORDER BY Snaps DESC LIMIT 1;";
        $fourthQ = "SELECT Coverage, COUNT(Coverage) AS Snaps,(SELECT COUNT(*) FROM ".$team." WHERE Down = 4) AS TOTAL, COUNT(Coverage)/(SELECT COUNT(*) FROM ".$team." WHERE Down = 4)*100 AS PERCENT FROM ".$team." WHERE Down = 4 GROUP BY Coverage ORDER BY Snaps DESC LIMIT 1;";


        $runDownR = mysqli_query($link, $runDownQ) or die('Query failed:'.mysql_error());
        $secSevR = mysqli_query($link, $secSevQ) or die('Query failed:'.mysql_error());
        $thirdOneR = mysqli_query($link, $thirdOneQ) or die('Query failed:'.mysql_error());
        $thirdTwoR = mysqli_query($link, $thirdTwoQ) or die('Query failed:'.mysql_error());
        $thirdFourR = mysqli_query($link, $thirdFourQ) or die('Query failed:'.mysql_error());
        $thirdSevenR = mysqli_query($link, $thirdSevenQ) or die('Query failed:'.mysql_error());
        $thirdElevenR = mysqli_query($link, $thirdElevenQ) or die('Query failed:'.mysql_error());
        $fourthR = mysqli_query($link, $fourthQ) or die('Query failed:'.mysql_error());

        $runDownData = mysqli_fetch_array($runDownR);
        $secondSevenData = mysqli_fetch_array($secSevR);
        $thirdOneData = mysqli_fetch_array($thirdOneR);
        $thirdTwoData = mysqli_fetch_array($thirdTwoR);
        $thirdFourData = mysqli_fetch_array($thirdFourR);
        $thirdSevenData = mysqli_fetch_array($thirdSevenR);
        $thirdElevenData =mysqli_fetch_array($thirdElevenR);
        $fourthData = mysqli_fetch_array($fourthR);
?>



           <title>Webslesson Tutorial | Make Simple Pie Chart by Google Chart API with PHP Mysql</title>
           <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
           <script type="text/javascript">
           google.charts.load('current', {'packages':['corechart']});
           google.charts.load('current', {'packages':['bar']});
           google.charts.setOnLoadCallback(drawCoverageChart);
           google.charts.setOnLoadCallback(drawBlitzChart);
           google.charts.setOnLoadCallback(drawDownChart);

           function drawCoverageChart()
           {
                var data = google.visualization.arrayToDataTable([
                          ['Coverage', 'Snaps'],
                          <?php
                          while($covRow = mysqli_fetch_array($covResult))
                          {
                               echo "['".$covRow["Coverage"]."', ".$covRow["Snaps"]."],";
                          }
                          ?>
                     ]);
                var options = {
                      pieHole: 0.4
                     };
                var chart = new google.visualization.PieChart(document.getElementById('coveragePieChart'));
                chart.draw(data, options);
           }

           function drawBlitzChart(){
                var blitzData = google.visualization.arrayToDataTable([
                          ['Blitz', 'Frequency'],
                          <?php
                          while($blitzRow = mysqli_fetch_array($blitzResult))
                          {
                               echo "['".$blitzRow["Blitz"]."', ".$blitzRow["Frequency"]."],";
                          }
                          ?>
                     ]);
                var options = {
                      //title: 'Top Coverages',
                      //is3D:true,
                      pieHole: 0.4
                     };
                var chart = new google.visualization.PieChart(document.getElementById('blitzPieChart'));
                chart.draw(blitzData, options);
           }

           function drawDownChart(){
        var data = new google.visualization.arrayToDataTable([
                ['Situation', 'Snaps', 'Total'],
                ['Run Downs', <?php echo $runDownData['Snaps'].", ".$runDownData['TOTAL']?>],
                ['2 & 7',  <?php echo $secondSevenData['Snaps'].", ".$secondSevenData['TOTAL']?>],
                ['3 & 1',  <?php echo $thirdOneData['Snaps'].", ".$thirdOneData['TOTAL']?>],
                ['3 & 2-3',  <?php echo $thirdTwoData['Snaps'].", ".$thirdTwoData['TOTAL']?>],
                ['3 & 4-6',  <?php echo $thirdFourData['Snaps'].", ".$thirdFourData['TOTAL']?>],
                ['3 & 7-10',  <?php echo $thirdSevenData['Snaps'].", ".$thirdSevenData['TOTAL']?>],
                ['3 & 11+',  <?php echo $thirdElevenData['Snaps'].", ".$thirdElevenData['TOTAL']?>],
                ['4 & 1+',  <?php echo $fourthData['Snaps'].", ".$fourthData['TOTAL']?>],
        ]);



        var options = {
          bars: 'vertical', // Required for Material Bar Charts.
        };

      var chart = new google.charts.Bar(document.getElementById('downChart'));
      chart.draw(data, options);
    }

        </script>
		<div id = "pieCharts" align="center">
			<div id = "coverage">
                        <h3 align="center">Top Coverages</h3>
			<div id="coveragePieChart" align="center" style="width: 100%; height: 500px;"></div>
			</div>
			<div id = "blitz">
                        <h3 align="center">Top Blitzes</h3>
			<div id="blitzPieChart" align="center" style="width: 100%; height: 500px;"></div>
			</div>
                </div>



<!--===========================First Column==========================-->
<div class="row">
  <div class="column" style="background-color:#0c2340;">
    <h2><center>Top 5 Overall Coverages</center></h2>

<!-- Top 5 Overall Coverages -->    
    <p>
      <?php
        $sql = "SELECT Coverage, COUNT(Coverage) AS Snaps, COUNT(Coverage)/(SELECT COUNT(*) FROM {$team})*100 AS PERCENT FROM {$team} GROUP BY Coverage ORDER BY Snaps DESC LIMIT 5";
  
      if($result = mysqli_query($link, $sql)){
        if(mysqli_num_rows($result) > 0){
          echo "<center><table>";
            echo "<tr>";
              echo "<th>Coverage</th>";
              echo "<th>Snaps</th>";
              echo "<th>Percent</th>";
            echo "</tr>";

	    while($row = mysqli_fetch_array($result)){
	      echo "<tr>";
	        for ($i=0; $i < mysqli_field_count($link); $i++){
	          echo "<td>" . $row[$i] . "</td>";
	        }
	      echo "</tr>";
            }
          echo "</table></center>";
          mysqli_free_result($result);
        }
      }
?>
   </p>

<!-- One High Safety -->
  <h2><center>One High Safety</center></h2>
  <p>
<?php
$sql = "SELECT Coverage, COUNT(Coverage) AS Snaps FROM {$team} WHERE MOFO_Safeties = 'C' GROUP BY Coverage ORDER BY Snaps DESC LIMIT 7";   

  if($result = mysqli_query($link, $sql)){
    if(mysqli_num_rows($result) > 0){
      echo "<center><table>";
        echo "<tr>";
          echo "<th>Coverage</th>";
          echo "<th>Snaps</th>";
        echo "</tr>";

	while($row = mysqli_fetch_array($result)){
	  echo "<tr>";
	    for ($i=0; $i < mysqli_field_count($link); $i++){
	      echo "<td>" . $row[$i] . "</td>";
	    }
	  echo "</tr>";
        }
      echo "</table></center>";
      mysqli_free_result($result);
      }
    }
?>
  </p> 

<!-- Coverages by Down and Distance -->
  <h2><center>Top Coverages by Down and Distance</center></h2>
  <p>
<?php

//Run downs
$sql = "SELECT Coverage, COUNT(Coverage) AS Snaps, COUNT(Coverage)/(SELECT COUNT(*) FROM {$team} WHERE Down = 1 OR (Down = 2 AND Dist <= 6))*100 AS PERCENT FROM {$team} WHERE Down = 1 OR (Down = 2 AND Dist <= 6) GROUP BY Coverage ORDER BY Snaps DESC LIMIT 1";

  if($result = mysqli_query($link, $sql)){
    if(mysqli_num_rows($result) > 0){
      echo "<center><table>";
        echo "<tr>";
          echo "<th>Down & Dist</th>";
          echo "<th>Coverage</th>";
          echo "<th>Snaps</th>";
	  echo "<th>Percent</th>";
        echo "</tr>";

	while($row = mysqli_fetch_array($result)){
	  echo "<tr>";
  	  echo "<td>Run Downs</td>";
	    for ($i=0; $i < mysqli_field_count($link); $i++){
	      echo "<td>" . $row[$i] . "</td>";
	    }
	  echo "</tr>";
        }
      mysqli_free_result($result);
      }
    }

//2nd and 7+ 
$sql = "SELECT Coverage, COUNT(Coverage) AS Snaps, COUNT(Coverage)/(SELECT COUNT(*) FROM {$team} WHERE Down = 2 AND Dist > 6)*100 AS PERCENT FROM {$team}  WHERE Down = 2 AND Dist > 6 GROUP BY Coverage ORDER BY Snaps DESC LIMIT 1";

  if($result = mysqli_query($link, $sql)){
    if(mysqli_num_rows($result) > 0){
	while($row = mysqli_fetch_array($result)){
	  echo "<tr>";
	    echo "<td>2nd & 7+</td>";
	    for ($i=0; $i < mysqli_field_count($link); $i++){
	      echo "<td>" . $row[$i] . "</td>";
	    }
	  echo "</tr>";
        }
      mysqli_free_result($result);
      }
    }

//3rd and 1
$sql = "SELECT Coverage, COUNT(Coverage) AS Snaps, COUNT(Coverage)/(SELECT COUNT(*) FROM {$team} WHERE Down = 3 AND Dist =1)*100 AS PERCENT FROM {$team} WHERE Down = 3 AND Dist = 1 GROUP BY Coverage ORDER BY Snaps DESC LIMIT 1";

  if($result = mysqli_query($link, $sql)){
    if(mysqli_num_rows($result) > 0){
	while($row = mysqli_fetch_array($result)){
	  echo "<tr>";
	    echo "<td>3rd & 1</td>";
	    for ($i=0; $i < mysqli_field_count($link); $i++){
	      echo "<td>" . $row[$i] . "</td>";
	    }
	  echo "</tr>";
        }
      mysqli_free_result($result);
      }
    }

//3rd and 2-3
$sql = "SELECT Coverage, COUNT(Coverage) AS Snaps, COUNT(Coverage)/(SELECT COUNT(*) FROM {$team} WHERE Down = 3 AND Dist > 1 AND Dist < 4)*100 AS PERCENT FROM {$team} WHERE Down = 3 AND Dist < 4 AND Dist > 1 GROUP BY Coverage ORDER BY Snaps DESC LIMIT 1";

  if($result = mysqli_query($link, $sql)){
    if(mysqli_num_rows($result) > 0){
	while($row = mysqli_fetch_array($result)){
	  echo "<tr>";
	  echo "<td>3rd & 2-3</td>";
	    for ($i=0; $i < mysqli_field_count($link); $i++){
	      echo "<td>" . $row[$i] . "</td>";
	    }
	  echo "</tr>";
        }
      mysqli_free_result($result);
      }
    }

//3rd and 4-6
$sql = "SELECT Coverage, COUNT(Coverage) AS Snaps, COUNT(Coverage)/(SELECT COUNT(*) FROM {$team} WHERE Down = 3 AND Dist > 3 AND Dist < 7)*100 AS PERCENT FROM {$team} WHERE Down = 3 AND Dist < 7 AND Dist > 3 GROUP BY Coverage ORDER BY Snaps DESC LIMIT 1";

  if($result = mysqli_query($link, $sql)){
    if(mysqli_num_rows($result) > 0){
	while($row = mysqli_fetch_array($result)){
	  echo "<tr>";
	    echo "<td>3rd & 4-6</td>";
	    for ($i=0; $i < mysqli_field_count($link); $i++){
	      echo "<td>" . $row[$i] . "</td>";
	    }
	  echo "</tr>";
        }
      mysqli_free_result($result);
      }
    }

//3rd and 7-10
$sql = "SELECT Coverage, COUNT(Coverage) AS Snaps, COUNT(Coverage)/(SELECT COUNT(*) FROM {$team} WHERE Down = 3 AND Dist > 6 AND Dist < 11)*100 AS PERCENT FROM {$team} WHERE Down = 3 AND Dist < 11 AND Dist > 6 GROUP BY Coverage ORDER BY Snaps DESC LIMIT 1";

  if($result = mysqli_query($link, $sql)){
    if(mysqli_num_rows($result) > 0){
	while($row = mysqli_fetch_array($result)){
	  echo "<tr>";
	    echo "<td>3rd & 7-10</td>";
	    for ($i=0; $i < mysqli_field_count($link); $i++){
	      echo "<td>" . $row[$i] . "</td>";
	    }
	  echo "</tr>";
        }
      mysqli_free_result($result);
      }
    }

//3rd and 11+
$sql = "SELECT Coverage, COUNT(Coverage) AS Snaps, COUNT(Coverage)/(SELECT COUNT(*) FROM {$team} WHERE Down = 3 AND Dist > 10)*100 AS PERCENT FROM {$team} WHERE Down = 3 AND Dist > 10 GROUP BY Coverage ORDER BY Snaps DESC LIMIT 1";

  if($result = mysqli_query($link, $sql)){
    if(mysqli_num_rows($result) > 0){
	while($row = mysqli_fetch_array($result)){
	  echo "<tr>";
	    echo "<td>3rd & 11+</td>";
	    for ($i=0; $i < mysqli_field_count($link); $i++){
	      echo "<td>" . $row[$i] . "</td>";
	    }
	  echo "</tr>";
        }
      mysqli_free_result($result);
      }
    }

//4th & 1+
$sql = "SELECT Coverage, COUNT(Coverage) AS Snaps, COUNT(Coverage)/(SELECT COUNT(*) FROM {$team} WHERE Down = 4)*100 AS PERCENT FROM {$team} WHERE Down = 4 GROUP BY Coverage ORDER BY Snaps DESC LIMIT 1";

  if($result = mysqli_query($link, $sql)){
    if(mysqli_num_rows($result) > 0){
	while($row = mysqli_fetch_array($result)){
	  echo "<tr>";
	    echo "<td>4th & 1+</td>";
	    for ($i=0; $i < mysqli_field_count($link); $i++){
	      echo "<td>" . $row[$i] . "</td>";
	    }
	  echo "</tr>";
        }
      echo "</table></center>";
      mysqli_free_result($result);
      }
    }
?>
  </p>

<!-- Top non blitzing coverage -->
  <h2><center>Top Non-Blitzing Coverage</center></h2>
  <p>
<?php
$sql = "SELECT Blitz, COUNT(*) AS Snaps FROM {$team} GROUP BY Blitz ORDER BY Snaps DESC LIMIT 1";

  if($result = mysqli_query($link, $sql)){
    if(mysqli_num_rows($result) > 0){
      echo "<center><table>";
        echo "<tr>";
          echo "<th>Coverage</th>";
          echo "<th>Snaps</th>";
        echo "</tr>";

	while($row = mysqli_fetch_array($result)){
	  echo "<tr>";
	    for ($i=0; $i < mysqli_field_count($link); $i++){
	      echo "<td>" . $row[$i] . "</td>";
	    }
	  echo "</tr>";
        }
      echo "</table></center>";
      mysqli_free_result($result);
      }
    }
?>
  </p>

<!-- Favorite blitzes -->
  <h2><center>Favorite Blitzes</center></h2>
  <p>

<?php
$sql = "SELECT Blitz, (SELECT COUNT(*) FROM {$team} WHERE Blitz != (SELECT Blitz FROM {$team} GROUP BY Blitz ORDER BY COUNT(*) DESC LIMIT 1)) AS Total, COUNT(*) AS Frequency, COUNT(*)/(SELECT COUNT(*) FROM {$team} WHERE Blitz != (SELECT Blitz FROM {$team} GROUP BY Blitz ORDER BY COUNT(*) DESC LIMIT 1))*100 AS Percent FROM {$team} WHERE Blitz != (SELECT Blitz FROM {$team} GROUP BY Blitz ORDER BY COUNT(*) DESC LIMIT 1) GROUP BY Blitz ORDER BY Frequency DESC LIMIT 7";

  if($result = mysqli_query($link, $sql)){
    if(mysqli_num_rows($result) > 0){
      echo "<center><table>";
        echo "<tr>";
          echo "<th>Blitzes</th>";
 	  echo "<th>Total</th>";
          echo "<th># of blitz</th>";
	  echo "<th>Percent</th>";
        echo "</tr>";

	while($row = mysqli_fetch_array($result)){
	  echo "<tr>";
	    for ($i=0; $i < mysqli_field_count($link); $i++){
	      echo "<td>" . $row[$i] . "</td>";
	    }
	  echo "</tr>";
        }
      echo "</table></center>";
      mysqli_free_result($result);
      }
    }
?>
  </p>
</div>


<!--========================Second Column==========================-->

  <div class="column" style="background-color:#c99700;">
    <h2><center>Top 5 Redzone Coverages</center></h2>
    <p>
      <?php
        $sql = "SELECT Coverage, COUNT(Coverage) AS Snaps, COUNT(Coverage)/(SELECT COUNT(*) FROM {$team})*100 AS PERCENT FROM {$team}  WHERE FieldPos <= 20 AND FieldPos >= 0 GROUP BY Coverage ORDER BY Snaps DESC LIMIT 5";
 
        if($result = mysqli_query($link, $sql)){
          if(mysqli_num_rows($result) > 0){
            echo "<center><table>";
              echo "<tr>";
                echo "<th>Coverage</th>";
                echo "<th>Snaps</th>";
                echo "<th>Percent</th>";
              echo "</tr>";

      	      while($row = mysqli_fetch_array($result)){
	        echo "<tr>";
	          for ($i=0; $i < mysqli_field_count($link); $i++){
	            echo "<td>" . $row[$i] . "</td>";
	          }
	        echo "</tr>";
              }
            echo "</table></center>";
            mysqli_free_result($result);
          }
        }
        ?>
    </p>

<!-- Two High Safeties -->
  <h2><center>Two High Safeties</center></h2>
  <p>

<?php

$sql = "SELECT Coverage, COUNT(Coverage) AS Snaps FROM {$team} WHERE MOFO_Safeties = 'O' GROUP BY Coverage ORDER BY Snaps DESC LIMIT 7";   

  if($result = mysqli_query($link, $sql)){
    if(mysqli_num_rows($result) > 0){
      echo "<center><table>";
        echo "<tr>";
          echo "<th>Coverage</th>";
          echo "<th>Snaps</th>";
        echo "</tr>";

	while($row = mysqli_fetch_array($result)){
	  echo "<tr>";
	    for ($i=0; $i < mysqli_field_count($link); $i++){
	      echo "<td>" . $row[$i] . "</td>";
	    }
	  echo "</tr>";
        }
      echo "</table></center>";
      mysqli_free_result($result);
      }
    }
?>
  </p>

<!-- High Redzone -->
  <h2><center>High Redzone</center><h2>
  <p>

<?php
  $sql="SELECT Coverage, COUNT(Coverage) AS Snaps, COUNT(Coverage)/(SELECT COUNT(*) FROM {$team})*100 AS PERCENT FROM {$team} WHERE FieldPos <= 20 AND FieldPos >= 11 GROUP BY Coverage ORDER BY Snaps DESC LIMIT 3";

  if($result = mysqli_query($link, $sql)){
    if(mysqli_num_rows($result) > 0){
      echo "<center><table>";
        echo "<tr>";
          echo "<th>Coverage</th>";
          echo "<th>Snaps</th>";
          echo "<th>Percent</th>";
        echo "</tr>";

	while($row = mysqli_fetch_array($result)){
	  echo "<tr>";
	    for ($i=0; $i < mysqli_field_count($link); $i++){
	      echo "<td>" . $row[$i] . "</td>";
	    }
	  echo "</tr>";
        }
      echo "</table></center>";
      mysqli_free_result($result);
      }
    }
?>
  </p>

<!-- Low Redzone -->
  <h2><center>Low Redzone</center><h2>
  <p>
<?php
  $sql="SELECT Coverage, COUNT(Coverage) AS Snaps, COUNT(Coverage)/(SELECT COUNT(*) FROM {$team})*100 AS PERCENT FROM {$team} WHERE FieldPos <= 10 AND FieldPos >= 0 GROUP BY Coverage ORDER BY Snaps DESC LIMIT 3";

  if($result = mysqli_query($link, $sql)){
    if(mysqli_num_rows($result) > 0){
      echo "<center><table>";
        echo "<tr>";
          echo "<th>Coverage</th>";
          echo "<th>Snaps</th>";
          echo "<th>Percent</th>";
        echo "</tr>";

	while($row = mysqli_fetch_array($result)){
	  echo "<tr>";
	    for ($i=0; $i < mysqli_field_count($link); $i++){
	      echo "<td>" . $row[$i] . "</td>";
	    }
	  echo "</tr>";
        }
      echo "</table></center>";
      mysqli_free_result($result);
      }
    }
?> 
  </p>

<!-- Blitzes by down and distance -->

  <h2><center>Blitzes by Down and Distance</center><h2>
  <p>
<?php
$sql = "SELECT (SELECT COUNT(*) FROM {$team} WHERE (Down = 1 OR Down = 2 AND Dist < 7) AND Blitz != (SELECT Blitz FROM {$team} GROUP BY Blitz ORDER BY COUNT(*) DESC LIMIT 1)) AS Blitzes, COUNT(*) AS Snaps, (SELECT COUNT(*) FROM {$team} WHERE (Down = 1 OR Down = 2 AND Dist < 7) AND Blitz != (SELECT Blitz FROM {$team} GROUP BY Blitz ORDER BY COUNT(*) DESC LIMIT 1))/COUNT(*)*100 AS Percent FROM {$team} WHERE (Down = 1 OR Down = 2 AND Dist < 7)";

  if($result = mysqli_query($link, $sql)){
    if(mysqli_num_rows($result) > 0){
      echo "<center><table>";
        echo "<tr>";
	  echo "<th>Down & Dist</th>";
          echo "<th>Blitzes</th>";
 	  echo "<th>Snaps</th>";
	  echo "<th>Percent</th>";
        echo "</tr>";

	while($row = mysqli_fetch_array($result)){
	  echo "<tr>";
	    echo "<td>Run Downs</td>";
	    for ($i=0; $i < mysqli_field_count($link); $i++){
	      echo "<td>" . $row[$i] . "</td>";
	    }
	  echo "</tr>";
        }
      mysqli_free_result($result);
      }
    }

//2nd and 7+
$sql = "SELECT (SELECT COUNT(*) FROM {$team} WHERE Down = 2 AND Dist > 6 AND Blitz != (SELECT Blitz FROM {$team} GROUP BY Blitz ORDER BY COUNT(*) DESC LIMIT 1)) AS Blitzes, COUNT(*) AS Snaps, (SELECT COUNT(*) FROM {$team} WHERE Down = 2 AND Dist > 6 AND Blitz != (SELECT Blitz FROM {$team} GROUP BY Blitz ORDER BY COUNT(*) DESC LIMIT 1))/COUNT(*)*100 AS Percent FROM {$team} WHERE Down = 2 AND Dist > 6";

  if($result = mysqli_query($link, $sql)){
    if(mysqli_num_rows($result) > 0){
	while($row = mysqli_fetch_array($result)){
	  echo "<tr>";
	    echo "<td>2nd & 7+</td>";
	    for ($i=0; $i < mysqli_field_count($link); $i++){
	      echo "<td>" . $row[$i] . "</td>";
	    }
	  echo "</tr>";
        }
      mysqli_free_result($result);
      }
    }

//3rd and 1
$sql = "SELECT (SELECT COUNT(*) FROM {$team} WHERE (Down = 3 AND Dist = 1) AND Blitz != (SELECT Blitz FROM {$team} GROUP BY Blitz ORDER BY COUNT(*) DESC LIMIT 1)) AS Blitzes, COUNT(*) AS Snaps, (SELECT COUNT(*) FROM {$team} WHERE (Down = 3 AND Dist = 1) AND Blitz != (SELECT Blitz FROM {$team} GROUP BY Blitz ORDER BY COUNT(*) DESC LIMIT 1))/COUNT(*)*100 AS Percent FROM {$team} WHERE (Down = 3 AND Dist = 1)";

  if($result = mysqli_query($link, $sql)){
    if(mysqli_num_rows($result) > 0){
	while($row = mysqli_fetch_array($result)){
	  echo "<tr>";
	    echo "<td>3rd & 1</td>";
	    for ($i=0; $i < mysqli_field_count($link); $i++){
	      echo "<td>" . $row[$i] . "</td>";
	    }
	  echo "</tr>";
        }
      mysqli_free_result($result);
      }
    }

//3rd and 2-3
$sql = "SELECT (SELECT COUNT(*) FROM {$team} WHERE (Down = 3 AND Dist < 4 AND Dist > 1) AND Blitz != (SELECT Blitz FROM {$team} GROUP BY Blitz ORDER BY COUNT(*) DESC LIMIT 1)) AS Blitzes, COUNT(*) AS Snaps, (SELECT COUNT(*) FROM {$team} WHERE (Down = 3 AND Dist < 4 AND Dist > 1) AND Blitz != (SELECT Blitz FROM {$team} GROUP BY Blitz ORDER BY COUNT(*) DESC LIMIT 1))/COUNT(*)*100 AS Percent FROM {$team} WHERE (Down = 3 AND Dist < 4 AND Dist > 1)";

  if($result = mysqli_query($link, $sql)){
    if(mysqli_num_rows($result) > 0){
	while($row = mysqli_fetch_array($result)){
	  echo "<tr>";
	    echo "<td>3rd & 2-3</td>";
	    for ($i=0; $i < mysqli_field_count($link); $i++){
	      echo "<td>" . $row[$i] . "</td>";
	    }
	  echo "</tr>";
        }
      mysqli_free_result($result);
      }
    }
//3rd and 4-6
$sql = "SELECT (SELECT COUNT(*) FROM {$team} WHERE (Down = 3 AND Dist < 7 AND Dist > 3) AND Blitz != (SELECT Blitz FROM {$team} GROUP BY Blitz ORDER BY COUNT(*) DESC LIMIT 1)) AS Blitzes, COUNT(*) AS Snaps, (SELECT COUNT(*) FROM {$team} WHERE (Down = 3 AND Dist < 7 AND Dist > 3) AND Blitz != (SELECT Blitz FROM {$team} GROUP BY Blitz ORDER BY COUNT(*) DESC LIMIT 1))/COUNT(*)*100 AS Percent FROM {$team} WHERE (Down = 3 AND Dist < 7 AND Dist > 3)";

  if($result = mysqli_query($link, $sql)){
    if(mysqli_num_rows($result) > 0){
	while($row = mysqli_fetch_array($result)){
	  echo "<tr>";
	    echo "<td>3rd & 4-6</td>";
	    for ($i=0; $i < mysqli_field_count($link); $i++){
	      echo "<td>" . $row[$i] . "</td>";
	    }
	  echo "</tr>";
        }
      mysqli_free_result($result);
      }
    }
//3rd and 7-10
$sql = "SELECT (SELECT COUNT(*) FROM {$team} WHERE (Down = 3 AND Dist < 11 AND Dist > 6) AND Blitz != (SELECT Blitz FROM {$team} GROUP BY Blitz ORDER BY COUNT(*) DESC LIMIT 1)) AS Blitzes, COUNT(*) AS Snaps, (SELECT COUNT(*) FROM {$team} WHERE Down = 3 AND Dist < 11 AND Dist > 6 AND Blitz != (SELECT Blitz FROM {$team} GROUP BY Blitz ORDER BY COUNT(*) DESC LIMIT 1))/COUNT(*)*100 AS Percent FROM {$team} WHERE Down = 3 AND Dist < 11 AND Dist > 6";

  if($result = mysqli_query($link, $sql)){
    if(mysqli_num_rows($result) > 0){
	while($row = mysqli_fetch_array($result)){
	  echo "<tr>";
	    echo "<td>3rd & 7-10</td>";
	    for ($i=0; $i < mysqli_field_count($link); $i++){
	      echo "<td>" . $row[$i] . "</td>";
	    }
	  echo "</tr>";
        }
      mysqli_free_result($result);
      }
    }
//3rd and 11+
$sql = "SELECT (SELECT COUNT(*) FROM {$team} WHERE (Down = 3 AND Dist > 10) AND Blitz != (SELECT Blitz FROM {$team} GROUP BY Blitz ORDER BY COUNT(*) DESC LIMIT 1)) AS Blitzes, COUNT(*) AS Snaps, (SELECT COUNT(*) FROM {$team} WHERE (Down = 3 AND Dist > 10) AND Blitz != (SELECT Blitz FROM {$team} GROUP BY Blitz ORDER BY COUNT(*) DESC LIMIT 1))/COUNT(*)*100 AS Percent FROM {$team} WHERE (Down = 3 AND Dist > 10)";

  if($result = mysqli_query($link, $sql)){
    if(mysqli_num_rows($result) > 0){
	while($row = mysqli_fetch_array($result)){
	  echo "<tr>";
	    echo "<td>3rd & 11+</td>";
	    for ($i=0; $i < mysqli_field_count($link); $i++){
	      echo "<td>" . $row[$i] . "</td>";
	    }
	  echo "</tr>";
        }
      mysqli_free_result($result);
      }
    }
//4th & 1+
$sql = "SELECT (SELECT COUNT(*) FROM {$team} WHERE (Down = 4) AND Blitz != (SELECT Blitz FROM {$team} GROUP BY Blitz ORDER BY COUNT(*) DESC LIMIT 1)) AS Blitzes, COUNT(*) AS Snaps, (SELECT COUNT(*) FROM {$team} WHERE  (Down = 4) AND Blitz != (SELECT Blitz FROM {$team} GROUP BY Blitz ORDER BY COUNT(*) DESC LIMIT 1))/COUNT(*)*100 AS Percent FROM {$team} WHERE (Down = 4)";

  if($result = mysqli_query($link, $sql)){
    if(mysqli_num_rows($result) > 0){
	while($row = mysqli_fetch_array($result)){
	  echo "<tr>";
	    echo "<td>4th & 1+</td>";
	    for ($i=0; $i < mysqli_field_count($link); $i++){
	      echo "<td>" . $row[$i] . "</td>";
	    }
	  echo "</tr>";
        }
      echo "</table>";
      mysqli_free_result($result);
      }
    }
?>
  </p>
  </div>
</div>
	<div id="downInfo" align="center">
		<h3 align="center">Top Blitz % by Down and Distance</h3>
        	<div id="downChart" align="center" style="width: 90%; height: 500px;"></div>
	</div>



<!-- Not used in report and not sure what to do with -->
<!-- Number of total blitzes -->
<p>
<b>Number of total blitzes</b>
<?php
$sql = "SELECT (SELECT COUNT(*) FROM {$team} WHERE Blitz != (SELECT Blitz FROM {$team} GROUP BY Blitz ORDER BY COUNT(*) DESC LIMIT 1)) AS Blitzes, COUNT(*) AS Snaps, (SELECT COUNT(*) FROM {$team} WHERE Blitz != (SELECT Blitz FROM {$team} GROUP BY Blitz ORDER BY COUNT(*) DESC LIMIT 1))/COUNT(*)*100 AS Percent FROM {$team}";

  if($result = mysqli_query($link, $sql)){
    if(mysqli_num_rows($result) > 0){
      echo "<table>";
        echo "<tr>";
          echo "<th>Blitzes</th>";
          echo "<th>Snaps</th>";
	  echo "<th>Percent</th>";
        echo "</tr>";

	while($row = mysqli_fetch_array($result)){
	  echo "<tr>";
	    for ($i=0; $i < mysqli_field_count($link); $i++){
	      echo "<td>" . $row[$i] . "</td>";
	    }
	  echo "</tr>";
        }
      echo "</table>";
      mysqli_free_result($result);
      }
    }
?>
</p>

<!-- Number of redzone blitzes -->
<p>
<b>Number of Redzone Blitzes</b>
<?php

$sql = "SELECT (SELECT COUNT(*) FROM {$team} WHERE FieldPos <= 20 AND FieldPos >= 0 AND Blitz != (SELECT Blitz FROM {$team} GROUP BY Blitz ORDER BY COUNT(*) DESC LIMIT 1)) AS Blitzes, COUNT(*) AS Snaps, (SELECT COUNT(*) FROM {$team} WHERE FieldPos <= 20 AND FieldPos >= 0 AND Blitz != (SELECT Blitz FROM {$team} GROUP BY Blitz ORDER BY COUNT(*) DESC LIMIT 1))/COUNT(*)*100 AS Percent FROM {$team} WHERE FieldPos <= 20 AND FieldPos >= 0";

  if($result = mysqli_query($link, $sql)){
    if(mysqli_num_rows($result) > 0){
      echo "<table>";
        echo "<tr>";
          echo "<th>Blitzes</th>";
          echo "<th>Snaps</th>";
	  echo "<th>Percent</th>";
        echo "</tr>";

	while($row = mysqli_fetch_array($result)){
	  echo "<tr>";
	    for ($i=0; $i < mysqli_field_count($link); $i++){
	      echo "<td>" . $row[$i] . "</td>";
	    }
	  echo "</tr>";
        }
      echo "</table>";
      mysqli_free_result($result);
      }
    }
?>
</p>

<!-- Number of redzone run downs -->
<p>
<b>Number of Redzone run downs</b>
<?php

$sql = "SELECT (SELECT COUNT(*) FROM {$team} WHERE FieldPos <= 20 AND FieldPos >= 0 AND (Down = 1 OR Down = 2 AND Dist < 7) AND Blitz != (SELECT Blitz FROM {$team} GROUP BY Blitz ORDER BY COUNT(*) DESC LIMIT 1)) AS Blitzes, COUNT(*) AS Snaps, (SELECT COUNT(*) FROM {$team} WHERE FieldPos <= 20 AND FieldPos >= 0 AND (Down = 1 OR Down = 2 AND Dist < 7) AND Blitz != (SELECT Blitz FROM {$team} GROUP BY Blitz ORDER BY COUNT(*) DESC LIMIT 1))/COUNT(*)*100 AS Percent FROM {$team} WHERE FieldPos <= 20 AND FieldPos >= 0 AND (Down = 1 OR Down = 2 AND Dist < 7)";

  if($result = mysqli_query($link, $sql)){
    if(mysqli_num_rows($result) > 0){
      echo "<table>";
        echo "<tr>";
          echo "<th>Run Downs</th>";
          echo "<th>Snaps</th>";
	  echo "<th>Percent</th>";
        echo "</tr>";

	while($row = mysqli_fetch_array($result)){
	  echo "<tr>";
	    for ($i=0; $i < mysqli_field_count($link); $i++){
	      echo "<td>" . $row[$i] . "</td>";
	    }
	  echo "</tr>";
        }
      echo "</table>";
      mysqli_free_result($result);
      }
    }
?>
</p>

<!-- Number of redzone 2nd 7+ -->
<p>
<b>Number of Redzone 2nd 7+</b>
<?php

$sql = "SELECT (SELECT COUNT(*) FROM {$team} WHERE FieldPos <= 20 AND FieldPos >= 0 AND (Down = 2 AND Dist > 6) AND Blitz != (SELECT Blitz FROM {$team} GROUP BY Blitz ORDER BY COUNT(*) DESC LIMIT 1)) AS Blitzes, COUNT(*) AS Snaps, (SELECT COUNT(*) FROM {$team} WHERE FieldPos <= 20 AND FieldPos >= 0 AND (Down = 2 AND Dist > 6) AND Blitz != (SELECT Blitz FROM {$team} GROUP BY Blitz ORDER BY COUNT(*) DESC LIMIT 1))/COUNT(*)*100 AS Percent FROM {$team} WHERE FieldPos <= 20 AND FieldPos >= 0 AND (Down = 2 AND Dist > 6)";

  if($result = mysqli_query($link, $sql)){
    if(mysqli_num_rows($result) > 0){
      echo "<table>";
        echo "<tr>";
          echo "<th>Blitzes</th>";
          echo "<th>Snaps</th>";
	  echo "<th>Percent</th>";
        echo "</tr>";

	while($row = mysqli_fetch_array($result)){
	  echo "<tr>";
	    for ($i=0; $i < mysqli_field_count($link); $i++){
	      echo "<td>" . $row[$i] . "</td>";
	    }
	  echo "</tr>";
        }
      echo "</table>";
      mysqli_free_result($result);
      }
    }
?>
</p>

<!-- Number of redzone 3rd and 1 -->
<p>
<b>Number of Redzone 3rd and 1</b>
<?php

$sql = "SELECT (SELECT COUNT(*) FROM {$team} WHERE FieldPos <= 20 AND FieldPos >= 0 AND (Down = 3 AND Dist = 1) AND Blitz != (SELECT Blitz FROM {$team} GROUP BY Blitz ORDER BY COUNT(*) DESC LIMIT 1)) AS Blitzes, COUNT(*) AS Snaps, (SELECT COUNT(*) FROM {$team} WHERE FieldPos <= 20 AND FieldPos >= 0 AND (Down = 3 AND Dist = 1) AND Blitz != (SELECT Blitz FROM {$team} GROUP BY Blitz ORDER BY COUNT(*) DESC LIMIT 1))/COUNT(*)*100 AS Percent FROM {$team} WHERE FieldPos <= 20 AND FieldPos >= 0 AND (Down = 3 AND Dist = 1)";

  if($result = mysqli_query($link, $sql)){
    if(mysqli_num_rows($result) > 0){
      echo "<table>";
        echo "<tr>";
          echo "<th>Blitzes</th>";
          echo "<th>Snaps</th>";
	  echo "<th>Percent</th>";
        echo "</tr>";

	while($row = mysqli_fetch_array($result)){
	  echo "<tr>";
	    for ($i=0; $i < mysqli_field_count($link); $i++){
	      echo "<td>" . $row[$i] . "</td>";
	    }
	  echo "</tr>";
        }
      echo "</table>";
      mysqli_free_result($result);
      }
    }
?>
</p>

<!-- Number of redzone 3rd and 2-3 -->
<p>
<b>Number of Redzone 3rd and 2-3</b>
<?php

$sql = "SELECT (SELECT COUNT(*) FROM {$team} WHERE FieldPos <= 20 AND FieldPos >= 0 AND (Down = 3 AND Dist < 4 AND Dist > 1) AND Blitz != (SELECT Blitz FROM {$team} GROUP BY Blitz ORDER BY COUNT(*) DESC LIMIT 1)) AS Blitzes, COUNT(*) AS Snaps, (SELECT COUNT(*) FROM {$team} WHERE FieldPos <= 20 AND FieldPos >= 0 AND (Down = 3 AND Dist < 4 AND Dist > 1) AND Blitz != (SELECT Blitz FROM {$team} GROUP BY Blitz ORDER BY COUNT(*) DESC LIMIT 1))/COUNT(*)*100 AS Percent FROM {$team} WHERE FieldPos <= 20 AND FieldPos >= 0 AND (Down = 3 AND Dist < 4 AND Dist > 1)";

  if($result = mysqli_query($link, $sql)){
    if(mysqli_num_rows($result) > 0){
      echo "<table>";
        echo "<tr>";
          echo "<th>Blitzes</th>";
          echo "<th>Snaps</th>";
	  echo "<th>Percent</th>";
        echo "</tr>";

	while($row = mysqli_fetch_array($result)){
	  echo "<tr>";
	    for ($i=0; $i < mysqli_field_count($link); $i++){
	      echo "<td>" . $row[$i] . "</td>";
	    }
	  echo "</tr>";
        }
      echo "</table>";
      mysqli_free_result($result);
      }
    }
?>
</p>

<!-- Number of redzone 3rd and 4-6 -->
<p>
<b>Number of Redzone 3rd and 4-6</b>
<?php

$sql = "SELECT (SELECT COUNT(*) FROM {$team} WHERE FieldPos <= 20 AND FieldPos >= 0 AND (Down = 3 AND Dist < 7 AND Dist > 3) AND Blitz != (SELECT Blitz FROM {$team} GROUP BY Blitz ORDER BY COUNT(*) DESC LIMIT 1)) AS Blitzes, COUNT(*) AS Snaps, (SELECT COUNT(*) FROM {$team} WHERE FieldPos <= 20 AND FieldPos >= 0 AND (Down = 3 AND Dist < 7 AND Dist > 3) AND Blitz != (SELECT Blitz FROM {$team} GROUP BY Blitz ORDER BY COUNT(*) DESC LIMIT 1))/COUNT(*)*100 AS Percent FROM {$team} WHERE FieldPos <= 20 AND FieldPos >= 0 AND (Down = 3 AND Dist < 7 AND Dist > 3)";

  if($result = mysqli_query($link, $sql)){
    if(mysqli_num_rows($result) > 0){
      echo "<table>";
        echo "<tr>";
          echo "<th>Blitzes</th>";
          echo "<th>Snaps</th>";
	  echo "<th>Percent</th>";
        echo "</tr>";

	while($row = mysqli_fetch_array($result)){
	  echo "<tr>";
	    for ($i=0; $i < mysqli_field_count($link); $i++){
	      echo "<td>" . $row[$i] . "</td>";
	    }
	  echo "</tr>";
        }
      echo "</table>";
      mysqli_free_result($result);
      }
    }
?>
</p>

<!-- Number of redzone 3rd and 7-10 -->
<p>
<b>Number of Redzone 3rd and 7-10</b>
<?php

$sql = "SELECT (SELECT COUNT(*) FROM {$team} WHERE FieldPos <= 20 AND FieldPos >= 0 AND (Down = 3 AND Dist < 11 AND Dist > 6) AND Blitz != (SELECT Blitz FROM {$team} GROUP BY Blitz ORDER BY COUNT(*) DESC LIMIT 1)) AS Blitzes, COUNT(*) AS Snaps, (SELECT COUNT(*) FROM {$team} WHERE FieldPos <= 20 AND FieldPos >= 0 AND (Down = 3 AND Dist < 11 AND Dist > 6) AND Blitz != (SELECT Blitz FROM {$team} GROUP BY Blitz ORDER BY COUNT(*) DESC LIMIT 1))/COUNT(*)*100 AS Percent FROM {$team} WHERE FieldPos <= 20 AND FieldPos >= 0 AND (Down = 3 AND Dist < 11 AND Dist > 6)";

  if($result = mysqli_query($link, $sql)){
    if(mysqli_num_rows($result) > 0){
      echo "<table>";
        echo "<tr>";
          echo "<th>Blitzes</th>";
          echo "<th>Snaps</th>";
	  echo "<th>Percent</th>";
        echo "</tr>";

	while($row = mysqli_fetch_array($result)){
	  echo "<tr>";
	    for ($i=0; $i < mysqli_field_count($link); $i++){
	      echo "<td>" . $row[$i] . "</td>";
	    }
	  echo "</tr>";
        }
      echo "</table>";
      mysqli_free_result($result);
      }
    }
?>
</p>

<!-- Number of redzone 3rd and 11+ -->
<p>
<b>Number of Redzone 3rd and 11+</b>
<?php

$sql = "SELECT (SELECT COUNT(*) FROM {$team} WHERE FieldPos <= 20 AND FieldPos >= 0 AND (Down = 3 AND Dist > 10) AND Blitz != (SELECT Blitz FROM {$team} GROUP BY Blitz ORDER BY COUNT(*) DESC LIMIT 1)) AS Blitzes, COUNT(*) AS Snaps, (SELECT COUNT(*) FROM {$team} WHERE FieldPos <= 20 AND FieldPos >= 0 AND (Down = 3 AND Dist > 10) AND Blitz != (SELECT Blitz FROM {$team} GROUP BY Blitz ORDER BY COUNT(*) DESC LIMIT 1))/COUNT(*)*100 AS Percent FROM {$team} WHERE FieldPos <= 20 AND FieldPos >= 0 AND (Down = 3 AND Dist > 10)";

  if($result = mysqli_query($link, $sql)){
    if(mysqli_num_rows($result) > 0){
      echo "<table>";
        echo "<tr>";
          echo "<th>Blitzes</th>";
          echo "<th>Snaps</th>";
	  echo "<th>Percent</th>";
        echo "</tr>";

	while($row = mysqli_fetch_array($result)){
	  echo "<tr>";
	    for ($i=0; $i < mysqli_field_count($link); $i++){
	      echo "<td>" . $row[$i] . "</td>";
	    }
	  echo "</tr>";
        }
      echo "</table>";
      mysqli_free_result($result);
      }
    }
?>
</p>

<!-- Number of redzone 4th -->
<p>
<b>Number of Redzone 4th</b>
<?php

$sql = "SELECT (SELECT COUNT(*) FROM {$team} WHERE FieldPos <= 20 AND FieldPos >= 0 AND (Down = 4) AND Blitz != (SELECT Blitz FROM {$team} GROUP BY Blitz ORDER BY COUNT(*) DESC LIMIT 1)) AS Blitzes, COUNT(*) AS Snaps, (SELECT COUNT(*) FROM {$team} WHERE FieldPos <= 20 AND FieldPos >= 0 AND (Down = 4) AND Blitz != (SELECT Blitz FROM {$team} GROUP BY Blitz ORDER BY COUNT(*) DESC LIMIT 1))/COUNT(*)*100 AS Percent FROM {$team} WHERE FieldPos <= 20 AND FieldPos >= 0 AND (Down = 4)";

  if($result = mysqli_query($link, $sql)){
    if(mysqli_num_rows($result) > 0){
      echo "<table>";
        echo "<tr>";
          echo "<th>Blitzes</th>";
          echo "<th>Snaps</th>";
	  echo "<th>Percent</th>";
        echo "</tr>";

	while($row = mysqli_fetch_array($result)){
	  echo "<tr>";
	    for ($i=0; $i < mysqli_field_count($link); $i++){
	      echo "<td>" . $row[$i] . "</td>";
	    }
	  echo "</tr>";
        }
      echo "</table>";
      mysqli_free_result($result);
      }
    }
?>
</p>

<?php
mysqli_close($link);
?>
</body>
</html>
