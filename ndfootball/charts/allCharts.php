<!--AllCharts-->
<?php
session_start();
?>

<html>
	<head>
	<link rel="stylesheet" href="styles.css">

<?php
	$team = $_GET["team"];

	$link = mysqli_connect('localhost', 'mcoffey1', 'mcoffey1') or die ('could not connect'.mysql_error());
        echo 'Connected successfully';
  	mysqli_select_db($link, 'mcoffey1') or die ('Could not select db');
  	echo ' Successfully db selected';

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

	</head>
	<body>
           <br /><br />
	   <div style="width:900px;">
	   <p><a href="testing.php">Return</a></p>
		<div id = "pieCharts" align="center">
                	<h3 align="center">Top Coverages</h3>
                	<div id="coveragePieChart" align="center" style="width: 500px; height: 500px;"></div>
			<br />
                	<h3 align="center">Top Blitzes</h3>
                	<br />
			<div id="blitzPieChart" align="center" style="width: 500px; height: 500px;"></div>
		</div>
		<h3 align="center">Top % by Down and Distance</h3>
		<br />
		<div id="downChart" align="center" style="width: 500px; height: 500px;"></div>
           </div>
      </body>
 </html>

