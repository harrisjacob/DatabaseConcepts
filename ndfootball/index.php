<!DOCTYPE html>
<html>
<head>
<title>NDfootball Analytics</title>
<link rel="stylesheet" href="styles.css">
<link rel="shortcut icon" href="ND_monogram_black_L.png"/>
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

<!-- Homepage -->
<h1 id='banner_header'>ND Football</h1>

<div id="outer_main_div" class="tabcontent">
  <h3 class='outlined'>Welcome!</h3>
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
<h3 class='outlined'>The Goal</h3>
<p>
Our mission is to utilize the power of statistics to help
Notre Dame football efficiently scout its opponents 
as well as itself
</p>
<h3 class='outlined'>Features</h3>
<div id='features'>
	<div>INFO<span class='tooltip'>INFO can be found about any play stored in our database of Notre Dame's recent opponents</span></div>
	<div>INSERT<span class='tooltip'>INSERT data of your own into our database, whether that be an individual play or an entire game</span></div>
	<div>UPDATE<span class='tooltip'>UPDATE a play, modifying anything from down to formation</span></div>
	<div>DELETE<span class='tooltip'>DELETE any plays you may have mistakenly entered!</span></div>
	<div>GENERATE REPORT<span class='tooltip'>GENERATE REPORT to give a detailed breakdown of an opponent's playstyle</span></div>
	<div>PREDICT<span class='tooltip'>PREDICT an opponent's next move using the power of machine learning!</span></div>
</div>
<h3 class='outlined'>Contributors</h3>
<ul>
	<li>Matthew Coffey</li>
	<li>Jacob Harris</li>
	<li>Stephen Grisoli</li>
	<li>Kieran McDonald</li>
</ul>
</div>

<!-- Query Tab -->
<?php 
  $sql = "show tables";
  echo "<div id=\"outer_info_div\" class=\"tabcontent\">";
  echo "<h3 class='outlined'>Info</h3>";

  if($result = mysqli_query($link, $sql)){
    if(mysqli_num_rows($result) > 0){
	echo "<form action='basic_query.php' method='get' id='query_form1'>";
 	echo "<div id='query_div' class='basic_elem'>";
	echo "<h3>Select a Team:</h3>";
	echo "<select name='team'>";
	while($row = mysqli_fetch_array($result)){
	    for ($i=0; $i < mysqli_field_count($link); $i++){
	      echo "<option value=$row[$i] . \"</option>";
	      echo "$row[$i]";
	    }
	}
           echo "</select>";
	   echo "</div>";
	mysqli_free_result($result);
     }
   }

  echo "<h3> Find info about a play:</h3>";
  echo "<p>Enter play name: <input type='textbox' name='play_query'/></p>";
  echo "<button type='submit' value='submit' class='button'>Submit</button>";
  echo "<p>(Example: 17-02 ND OFF VS UGA PLAY 001)</p>";
  echo "<br>";
  echo "<p>Or, enter minimum Gain amount to find play names: <input type='number' name='gain_amount' value=200 />";
  echo "<button type='submit' value='submit' class='button'>Submit</button></p>";
  echo "</form>";
  echo "</div>";
?>


<!-- Insert Tab -->
<?php

  $sql = "show tables";
  echo "<div id=\"outer_insert_div\" class=\"tabcontent\">";
  echo "<h3 class='outlined'>Insert</h3>";
  if($result = mysqli_query($link, $sql)){
    if(mysqli_num_rows($result) > 0){
      echo "<form action='basic_insert.php' method='get' id=\"insert_form\">";
      echo "<div id='insert_div' class='basic_elem'>";
      echo "<h3>Select a Team:</h3>";
      echo "<select name=\"team\">"; 
      while($row = mysqli_fetch_array($result)){
	for($i=0; $i < mysqli_field_count($link); $i++){
          echo "<option value=$row[$i] . \"</option>";
	  echo "$row[$i]";
        }
      }
    echo "</select>";
   // echo "</div>";
    mysqli_free_result($result);
  }
}
?>
 
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
  </form>  
  </div>

  <div id='insert_csv' class='basic_elem'>
  <form action='csv_insert.php' method='get' id='csv_insert'>
  <h3>Upload CSV here:</h3>
  <p>Opponent: <input type='text' name='opponent' id='opponent'></p>
  <label for="play_file">Path to properly formatted CSV file:</label>
  <input type="text" id="play_file" name='csv_file'>
  <p><button id='upload_button'>Upload</button></p>
  </form>
  </div>
  </div>

<!-- Update Tab -->
<div id="outer_update_div" class="tabcontent">
  <h3 class='outlined'>Update</h3>

<?php
  $sql = "show tables";
  if($result = mysqli_query($link, $sql)){
    if(mysqli_num_rows($result) > 0){
      echo "<form action='basic_update.php' method='get'>";
      echo "<div id='update_div' class='basic_elem'>";
      echo "<h3>Select a Team:</h3>";
      echo "<select name=\"team\">"; 
      while($row = mysqli_fetch_array($result)){
        for($i=0; $i < mysqli_field_count($link); $i++){
          echo "<option value=$row[$i] . \"</option>";
	  echo "$row[$i]";
        }
      }
    echo "</select>";
    mysqli_free_result($result);
    }
  }
?>

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

<!-- Delete Tab -->
<?php 
  $sql = "show tables";
  echo "<div id=\"outer_delete_div\" class=\"tabcontent\">";
  echo "<h3 class='outlined'>Delete</h3>";

//select tables for drop down
  if($result = mysqli_query($link, $sql)){
    if(mysqli_num_rows($result) > 0){
	echo "<form action='basic_delete.php' method='get' id='delete_form1'>";
 	echo "<div id='delete_div' class='basic_elem'>";
	echo "<h3>Select a Team:</h3>";
	echo "<select name='team'>";
	while($row = mysqli_fetch_array($result)){
	    for ($i=0; $i < mysqli_field_count($link); $i++){
	      echo "<option value=$row[$i] . \"</option>";
	      echo "$row[$i]";
	    }
	}
           echo "</select>";
	   echo "</div>";
	mysqli_free_result($result);
     }
   }

  echo "<p>Play Name:<input name='play_query' id='delete_name' type='text'/></p>";
  echo "<button id='delete_button'>Submit</button>";
  echo "</form>";
  echo "</div>";
?>

<!-- Generate Report Tab -->
<?php
$sql = "show tables";
echo "<div id=\"outer_report_div\" class=\"tabcontent\">";
echo "<h3 class='outlined'>Generate Report</h3>";

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

<!-- Predict Tab -->
<div id='outer_predict_div' class='tabcontent'>
	<h1>Predict the defense's coverage</h1>
	<h3>Fill in the fields below to generate a coverage prediction</h3>

<?php 
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
	<br>
	<div id="inputs">
	<p><label for="Situation">Situation:</label><input type='text' name='Situation'>
  <label for="pff_DRIVESTARTEVENT">Drive Start Event:</label><input type='text' name='pff_DRIVESTARTEVENT'>
  <br>
  <label for="Series"> Series Number:</label><input type='number' step='1' name='Series'>
  <label for="Quarter">Quarter:</label><select name='Quarter'><option value=1>1</option><option value=2>2</option><option value=3>3</option><option value=4>4</option></select>
  <br>
  <label for="pff_CLOCK">Clock:</label><input type='text' name='pff_CLOCK'>
  <label for="pff_SCORE">Score:</label><input type='number' step="0.01" name='pff_SCORE'>
  <br>
  <label for="Down">Down:</label><input type='number' name='Down'>
  <label for="Dist">Distance:</label><input type='number' name='Dist'>
  <br>
  <label for="FieldPos"> Field Position:</label><input type='number' name='FieldPos'>
  <label for="Hash">Hash:</label><input type='text' name='Hash'>
  <br>
  <label for="Personnel"> Personnel:</label><input type='number' name='Personnel'>
  <label for="Formation">Formation:</label><input type='text' name='Formation'>
  <br>
  <label for="MOFO_Safeties">Middle of Field Open (Safeties):</label><input type='text' name='MOFO_Safeties'></p>
  </form>
  </div>
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
	$empty_s= "''";
	$cmdin = '/var/www/html/cse30246/ndfootball/MLPredictor.py '.'"'.$sit.','.$start.','.$series.','.$quarter.','.$clock.','.$score.','.$down.','.$dist.','.$FieldPos.','.$hash.','.$pers.','.$form.','.$MOFO.','.$empty_s.'" '.$team;/*.'"2,PUNT - TB,4,2,1:06,3.21,1,10,-20,L,11,seedy-orchid-dormouse,O,"""'." ".$team;*/
	echo "<br>";
	$command = escapeshellcmd($cmdin);
    $output = shell_exec($command);
	echo $output;
	echo "<br>"

	?>
<div id="Sample">
<p>Sample: Situation = 2, RIVESTARTEVENT = PUNT, Series = 4, Quarter = 2, </br>
    Clock = 14:45, Score = 21.07 (Primary team has 21, opponent has 7), Down = 1, Dist = 10 </br>
    FieldPPos = -25 (own 25 yard line), Hash = R,  Personnel = 12 (1 back, 2 tight ends), </br>
    Formation = foggy-aquamarine-walrus (query table for more formations), Middle of field open (Safeties) = O (or C, O and C stand for open and closed)<p></br>
</div>
</div>

<!-- Tab Script -->
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
if (window.location.href.includes('Situation')){
	open_tab(null, 'outer_predict_div');
	document.getElementById('predict_button').className += " active";
} else {
	open_tab(null, 'outer_main_div');
	document.getElementById('first_button').className += " active";
}
</script>


   
</body>
</html> 
