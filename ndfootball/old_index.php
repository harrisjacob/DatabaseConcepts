<html>
<head>
<title>NDfootball Analytics</title>
<link rel="stylesheet" href="styles.css">
</head>
<body>
<div id='title_div'>
<h1>Demo URL</h1>
</div>
<div id='basics'>

<!--
<?php
  $link = mysqli_connect('localhost', 'mcoffey1', 'mcoffey1') or die ('could not connect');
  mysqli_select_db($link, 'mcoffey1') or die ('Could not select db');
  echo 'Successfully Connected';
?>
--!>

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
pff_SCORE: <input type='number' name='pff_SCORE'>
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

<form action='csv_insert.php' method='get' id='csv_insert'>
<div id='insert_csv' class='basic_elem'>
<h3>Upload CSV here:</h3>
<p>Opponent: <input type='text' name='opponent' id='opponent'></p>
<label for="play_file">Path to properly formatted CSV file:</label>
<input type="text" id="play_file" name='csv_file'>
<p><button id='upload_button'>Upload</button></p>
</div>
</form>

</body>
</html>
