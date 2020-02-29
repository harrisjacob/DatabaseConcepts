<!DOCTYPE html>
<html>
<head>
<title>NDfootball Analytics</title>
<link rel="stylesheet" href="styles.css">
</head>
<body>

<?php
  $link = mysqli_connect('localhost', 'mcoffey1', 'mcoffey1') or die ('Failed to connect to database');
  echo "\n";
  mysqli_select_db($link, 'mcoffey1') or die ('Could not select db');
?>


<div class="tab">
  <button class="tablinks" onclick="open_tab(event, 'outer_main_div')" id='first_button'>Main</button>
  <button class="tablinks" onclick="open_tab(event, 'outer_info_div')">Info</button>
  <button class="tablinks" onclick="open_tab(event, 'outer_insert_div')">Insert</button>
  <button class="tablinks" onclick="open_tab(event, 'outer_update_div')">Update</button>
  <button class="tablinks" onclick="open_tab(event, 'outer_delete_div')">Delete</button>
  <button class="tablinks" onclick="open_tab(event, 'outer_report_div')">Generate Report</button>
  <button class="tablinks" onclick="open_tab(event, 'outer_predict_div')" id='predict_button'>Predict</button>
</div>

<h1 id='banner_header'>ND Football</h1>

<div id="outer_main_div" class="tabcontent">
  <h3>Welcome!</h3>
<p>
Have you ever wondered what the type of formation
Georgia ran on the 56th play of their 2018 matchup
at Notre Dame? What about the top 4 redzone coverages
Duke used in the last year? Or maybe you have an urgent
desire to know what type of play Navy is most likely
to run if they have the ball down by 6 on 4th and goal
with 2:13 remaining? Fear no more! ND Football is your
one-stop site to answer all of your Notre Dame 
statistics-based questions!
</p>
<h3>The Goal</h3>
<p>
Our mission is to utilize the power of statistics to help
Notre Dame football efficiently scout its opponents 
as well as itself
</p>
<h3>Features</h3>
<div id='features'>
	<div>INFO<span class='tooltip'>INFO can be found about any play stored in our database of Notre Dame's recent opponents</span></div>
	<div>INSERT<span class='tooltip'>INSERT data of your own into our database, whether that be an individual play or an entire game</span></div>
	<div>UPDATE<span class='tooltip'>UPDATE a play, modifying anything from down to formation</span></div>
	<div>DELETE<span class='tooltip'>DELETE any plays you may have mistakenly entered!</span></div>
	<div>GENERATE REPORT<span class='tooltip'>GENERATE REPORT to give a detailed breakdown of an opponent's playstyle</span></div>
	<div>PREDICT<span class='tooltip'>PREDICT an opponent's next move using the power of machine learning!</span></div>
</div>
<h3>Contributors</h3>
<ul>
	<li>Matthew Coffey</li>
	<li>Jacob Harris</li>
	<li>Stephen Grisoli</li>
	<li>Kieran McDonald</li>
</ul>
</div>

<div id="outer_info_div" class="tabcontent">
  <h3>Info</h3>
  <h2>Select a Team: </h2>
  <form action='basic_query.php' method='get' id="query_form1"> 
  <select name="team">
    <option value="UGA">Georgia</option>
    <option value="BGSU">BGSU</option>
  </select>

  <h3>Find info about a play:</h3>

  Enter play name:<input type='textbox' name='play_query'/><br>
  <button type="submit" value="Submit" class="button">Submit</button>
  </form>
  <p>(Example: 17-02 ND OFF VS UGA Play 001)</p>
</div>

<div id="outer_insert_div" class="tabcontent">
  <h3>Insert</h3>
  <form action='basic_insert.php' method='get' id="insert_form">
  <div id='insert_div' class='basic_elem'>
  <h3>Insert data here:</h3>
  <select name="team">
    <option value="UGA">Georgia</option>
    <option value="BGSU">BGSU</option>
  </select>
  <p>Name: <input type='text' name='Name'></p>
  <p>Number: <input type='number' step='1' name='Number'>
  ObviousPlay: <input type='text' name='ObviousPlay'>
  Situation: <input type='number' step='1' name='Situation'></p>
  <p>pff_DRIVESTARTEVENT: <input type='text' name='pff_DRIVESTARTEVENT'>
  Series: <input type='number' step='1' name='Series'>
  Quarter: <select name='Quarter'><option value=1>1</option><option value=2>2</option><option value=3>3</option><option value=4>4</option></select></p>
  <p>pff_CLOCK: <input type='text' name='pff_CLOCK'>
  pff_SCORE: <input type='number' step="0.01" name='pff_SCORE'>
  Down: <input type='number' name='Down'>
  Dist: <input type='number' name='Dist'></p>
  <p>FieldPos: <input type='number' name='FieldPos'>
  Hash: <input type='text' name='Hash'>
  RorP: <input type='text' name='RorP'>
  Result: <input type='text' name='Result'></p>
  <p>Gain: <input type='number' name='Gain'>
  Explosive: <input type='text' name='Explosive'>
  Personnel: <input type='number' name='Personnel'>
  Formation: <input type='text' name='Formation'></p>
  <p>Coverage: <input type='text' name='Coverage'>
  MOFO_Safeties: <input type='text' name='MOFO_Safeties'>
  Play: <input type='text' name='Play'></p>
  <p>Backfield: <input type='text' name='Backfield'>
  LBBox: <input type='text' name='LBBox'>
  Front: <input type='text' name='Front'>
  Motion_Shift: <input type='text' name='Motion_Shift'></p>

  <button id='insert_button' type="submit" value="submit">Submit</button>
  </div>
  </form>  

  <form action='csv_insert.php' method='get' id='csv_insert'>
  <div id='insert_csv' class='basic_elem'>
  <h3>Upload CSV here:</h3>
  <p>Opponent: <input type='text' name='opponent' id='opponent'></p>
  <label for="play_file">Path to properly formatted CSV file:</label>
  <input type="text" id="play_file" name='csv_file'>
  <p><button id='upload_button'>Upload</button></p>
  </div>
  </form>
</div>

<div id="outer_update_div" class="tabcontent">
  <h3>Update</h3>
  <form action='basic_update.php' method='get'>
  <div id='update_div' class='basic_elem'>
  <h3>Update data here:</h3>
  <select name="team">
    <option value="UGA">Georgia</option>
    <option value="BGSU">BGSU</option>
  </select>
  <p>Play Name: <input name='update_name' id='update_name' type='text'></p>
  <p>Field to Modify:  
  <select name='update_select' id='update_select'>
  <option value=Number>Number</option>
  <option value=ObviousPlay>ObviousPlay</option>
  <option value=Situation>Situation</option>
  <option value=pff_DRIVESTARTEVENT>pff_DRIVESTARTEVENT</option>
  <option value=Series>Series</option>
  <option value=Quarter>Quarter</option>
  <option value=pff_CLOCK>pff_CLOCK</option>
  <option value=pff_SCORE>pff_SCORE</option>
  <option value=Down>Down</option>
  <option value=Dist>Dist</option>
  <option value=FieldPos>FieldPos</option>
  <option value=Hash>Hash</option>
  <option value=RorP>RorP</option>
  <option value=Result>Result</option>
  <option value=Gain>Gain</option>
  <option value=Explosive>Explosive</option>
  <option value=Personnel>Personnel</option>
  <option value=Formation>Formation</option>
  <option value=Coverage>Coverage</option>
  <option value=MOFO_Safeties>MOFO_Safeties</option>
  <option value=Play>Play</option>
  <option value=Backfield>Backfield</option>
  <option value=LBBox>LBBox</option>
  <option value=Front>Front</option>
  <option value=Motion_Shift>Motion_Shift</option>
  </select>
  </p>
  <p>New Data: <input id='update_data' name='update_data' type='text'></p>
  <button id='update_button' type='submit' value='submit'>Submit</button>
  </div>
  </form>
</div>

<div id="outer_delete_div" class="tabcontent">
  <h3>Delete</h3>
  <form action='basic_delete.php' method='get' id='delete_form'>
  <div id='delete_div' class='basic_elem'>
  <h3>Delete data here:</h3>
  <select name="team">
    <option value="UGA">Georgia</option>
    <option value="BGSU">BGSU</option>
  </select>
  <p>Play Name: <input name='play_query' id='delete_name' type='text'/></p>
  <button id='delete_button'>Submit</button>
  </div>
  </form>
</div>

<?php
$sql = "show tables";
echo "<div id=\"outer_report_div\" class=\"tabcontent\">";
echo "<h3>Generate Report</h3>";

  if($result = mysqli_query($link, $sql)){
    if(mysqli_num_rows($result) > 0){
	echo "<form action='sqlQueries/report_queries.php' method='get' id='report_form'>";
 	echo "<div id='report_div' class='basic_elem'>";
	echo "<select name='team'>";
	while($row = mysqli_fetch_array($result)){
	    for ($i=0; $i < mysqli_field_count($link); $i++){
	      echo "<option value=$row[$i] . \"</option>";
	      echo "$row[$i]";
	    }
	}
           echo "</select>";
	   echo "<button id='report_button'>Generarate Report</button>";
	   echo "</form>";
	   echo "</div>";
	   echo "</div>"; 
      mysqli_free_result($result);
      }
    }
?>

<div id='outer_predict_div' class='tabcontent'>
	<p>Second advanced function goes here</p>
	<?php 
		$command = escapeshellcmd('/var/www/html/cse30246/ndfootball/test.py "Hello World"');
		$output = shell_exec($command);
		echo $output;

$sql = "show tables";
  if($result = mysqli_query($link, $sql)){
    if(mysqli_num_rows($result) > 0){
	echo "<form action='index.php' method='get' id='predict_form'>";
 	echo "<div id='predict_div' class='basic_elem'>";
	echo "<select name='team'>";
	while($row = mysqli_fetch_array($result)){
	    for ($i=0; $i < mysqli_field_count($link); $i++){
	      echo "<option value=$row[$i] . \"</option>";
	      echo "$row[$i]";
	    }
	}
           echo "</select>";
	   echo "<button id='report_button'>Make Prediction</button>";
      mysqli_free_result($result);
      }
    }
	?>
	<p>Situation: <input type='text' name='Situation'>
  pff_DRIVESTARTEVENT: <input type='text' name='pff_DRIVESTARTEVENT'>
  Series: <input type='number' step='1' name='Series'>
  Quarter: <select name='Quarter'><option value=1>1</option><option value=2>2</option><option value=3>3</option><option value=4>4</option></select></p>
  <p>pff_CLOCK: <input type='text' name='pff_CLOCK'>
  pff_SCORE: <input type='number' step="0.01" name='pff_SCORE'>
  Down: <input type='number' name='Down'>
  Dist: <input type='number' name='Dist'></p>
  <p>FieldPos: <input type='number' name='FieldPos'>
  Hash: <input type='text' name='Hash'>
  Personnel: <input type='number' name='Personnel'>
  Formation: <input type='text' name='Formation'>
  MOFO_Safeties: <input type='text' name='MOFO_Safeties'></p>
  </form>
  </div>
	<?php
	$team=$_GET["team"];
	$sit=$_GET["Situation"];
	$start=$_GET["pff_DRIVESTARTEVENT"];
	$series=$_GET["Series"];
	$quarter=$_GET["Quarter"];
	$clock=$_GET["pff_CLOCK"];
	$score=$_GET["pff_SCORE"];
	$down=$_GET["Down"];
	$dist=$_GET["Dist"];
	$FieldPos=$_GET["FieldPos"];
	$hash=$_GET["Hash"];
	$pers=$_GET["Personnel"];
	$form=$_GET["Formation"];
	$MOFO=$_GET["MOFO_Safeties"];
	$cmdin = '/var/www/html/cse30246/ndfootball/test.py '.'"'.$sit.','.$start.','.$series.','.$series.','.$quarter.','.$clock.','.$score.','.$down.','.$dist.','.$FieldPos.','.$hash.','.$pers.','.$form.','.$MOFO.'" '.$team;
	$command = escapeshellcmd($cmdin);
    $output = shell_exec($command);
    echo "<br>";
	echo $output;

	?>
</div>

<script>
function open_tab(evt, div_name) {
  var i, tabcontent, tablinks;
  tabcontent = document.getElementsByClassName("tabcontent");
  for (i = 0; i < tabcontent.length; i++) {
    tabcontent[i].style.display = "none";
  }
  tablinks = document.getElementsByClassName("tablinks");
  for (i = 0; i < tablinks.length; i++) {
    tablinks[i].className = tablinks[i].className.replace(" active", "");
  }
  document.getElementById(div_name).style.display = "block";
  if (evt) evt.currentTarget.className += " active";
}
open_tab(null, 'outer_main_div');
document.getElementById('first_button').className += " active";
</script>


   
</body>
</html> 
