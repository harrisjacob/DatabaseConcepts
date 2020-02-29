<!--BlitzPer-->
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
You are looking for the Blitz Percentages of <?=$team?>.

<p>

<?php
        $link = mysqli_connect('localhost', 'mcoffey1', 'mcoffey1') or die ('could not connect'.mysql_error());
        echo 'Connected successfully';
        echo '\n';
  mysqli_select_db($link, 'mcoffey1') or die ('Could not select db');
  echo 'Successfully db selected';
  echo "\n";


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
<html>
  <head> 

	<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
	<script type="text/javascript">
	
	
	google.charts.load('current', {'packages':['bar']});
	google.charts.setOnLoadCallback(drawStuff);		

	function drawStuff(){	
        var data = google.visualization.arrayToDataTable([
	  ['Situation', 'Snaps', {role: 'tooltip'}, 'Total', {role: 'tooltip'}],
	  ['Run Downs', <?php echo $runDownData['Snaps'].", ".$runDownData['Snaps'].", ".($runDownData['TOTAL']-$runDownData['Snaps']).", ".$runDownData['PERCENT'] ?>],
          ['2015', 1170, 1, 460, 6],
          ['2016', 660, 2, 1120, 9],
          ['2017', 1030, 3, 540, 4]
        ]);

	var options = {
		tooltip: false,
		enableInteractivity: false,
		isStacked:true,
          chart: {
            title: 'Blitz Percentages of [TEAM]',
            //subtitle: 'Sales, Expenses, and Profit: 2014-2017',
          },
          bars: 'vertical' // Required for Material Bar Charts.

        };

        var chart = new google.charts.Bar(document.getElementById('barchart_material'));

        chart.draw(data, google.charts.Bar.convertOptions(options));
	}



	
    </script>
  </head>
  <body>
    <div id="barchart_material" style="width: 900px; height: 500px;"></div>
  </body>
</html>
