<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title>Guitar Wars - High Scores</title>
  <link rel="stylesheet" type="text/css" href="style.css" />
</head>
<body>
  <h2>Guitar Wars - High Scores</h2>
  <p>Welcome, Guitar Warrior, do you have what it takes to crack the high score list? </br> If so, just <a href="addscore.php">add your own score</a>.</p>
  <hr />
<div class="tables">
<?php
//die('asdf');
  // Connect to the database 
  require_once('connect.php');

  // Retrieve the score data from MySQL
  $query = "SELECT * FROM guitarwars ORDER by score DESC, date ASC";
  $data = mysqli_query($dbc, $query);

  // Loop through the array of score data, formatting it as HTML 
  echo '<table>';
  $i = 0;
  while ($row = mysqli_fetch_array($data)) { 
    // Display the score data
    if($i == 0){
      echo '<tr><td colspan="2" class="topscoreheader"> Top Score ' .
      $row['score']. '</td></tr>' ;
    }
    echo '<tr><td class="scoreinfo">';
    echo '<span class="score">' . $row['score'] . '</span><br />';
    echo '<strong>Name:</strong> ' . $row['name'] . '<br />';
    echo '<strong>Date:</strong> ' . $row['date'] . '</td>';
    
    if (!empty($row['screenshot'])) {
      echo '<td><img src=images/'. $row['screenshot'] .' alt="Score Image" class="images"></td></tr> ';
    }else
    {
      echo '<td><img src=images/unverified.gif alt="Unverified Score Image"></td></tr> ';
    }
    $i++;
   
  }
  echo '</table>';

  mysqli_close($dbc);
?>
</div>
</body> 
</html>
