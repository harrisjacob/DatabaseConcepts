<!--TopCoverages-->
<?php
session_start();
?>

<html>
<head>
<script type="text/javascript" src="scripts/json2.js"></script>
<title>Result of Query</title>
</head>

<body>
<p><a href="testing.php">Return</a></p>
<?php
  $team = $_GET["team"];
  //$test = 'UGA';
?>
You are looking for the Top Coverages for <?=$team?>.

<p>

<?php
	$link = mysqli_connect('localhost', 'mcoffey1', 'mcoffey1') or die ('could not connect'.mysql_error());
	echo 'Connected successfully';
	echo '\n';
  mysqli_select_db($link, 'mcoffey1') or die ('Could not select db');
  echo 'Successfully db selected';
  echo "\n";
	 
	$query = "SELECT Coverage, COUNT(Coverage) AS Snaps FROM ".$team." GROUP BY Coverage ORDER BY Snaps DESC LIMIT 10";
	 
	$result = mysqli_query($link, $query) or die('Query failed:'.mysql_error());
	echo $query;
?>  
 <!DOCTYPE html>  
 <html>  
      <head>  
           <title>Webslesson Tutorial | Make Simple Pie Chart by Google Chart API with PHP Mysql</title>  
           <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>  
           <script type="text/javascript">  
           google.charts.load('current', {'packages':['corechart']});  
           google.charts.setOnLoadCallback(drawChart);  
           function drawChart()  
           {  
                var data = google.visualization.arrayToDataTable([  
                          ['Coverage', 'Snaps'],  
                          <?php  
                          while($row = mysqli_fetch_array($result))  
                          {  
                               echo "['".$row["Coverage"]."', ".$row["Snaps"]."],";  
                          }  
                          ?>  
                     ]);  
                var options = {  
                      //title: 'Top Coverages',  
                      //is3D:true,  
                      pieHole: 0.4  
                     };  
                var chart = new google.visualization.PieChart(document.getElementById('piechart'));  
                chart.draw(data, options);  
           }  
           </script>  
      </head>  
      <body>  
           <br /><br />  
           <div style="width:900px;">  
                <h3 align="center">Top Coverages</h3>  
                <br />  
                <div id="piechart" align="center" style="width: 900px; height: 500px;"></div>  
           </div>  
      </body>  
 </html> 
