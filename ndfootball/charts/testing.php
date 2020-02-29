<!--Testing-->
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


<?php
//  $link = mysqli_connect('localhost', 'mcoffey1', 'mcoffey1') or die ('could not connect');
 // mysqli_select_db($link, 'mcoffey1') or die ('Could not select db');
 // echo 'Successfully Connected';
?>


<h2>Select a Team: </h2>
<form action='allCharts.php' method='get' id="query_form1"> 
<select name="team">
  <option value="UGA">Georgia</option>
  <option value="DUKE">Duke</option>
  <option value="NAVY">Navy</option>
  <option value="BC">Boston College</option>
</select>

<!---
<h3>Get the top coverages:</h3>
<button type="submit" value="Submit" class="button">Submit</button>
</form>
-->
<!---
<h3>Get the top Blitzes</h3>
<button type="submit" value="Submit" class="button">Submit</button>
</form>
-->
<h3>Get the blitz percentage</h3>
<button type="submit" value="Submit" class="button">Submit</button>
</form>



</body>
</html>
