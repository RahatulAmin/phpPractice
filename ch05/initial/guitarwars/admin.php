<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title>Guitar Wars - ADMINISTRATION</title>
  <link rel="stylesheet" type="text/css" href="style.css" />
</head>
<body>
  <h2>Guitar Wars - ADMINISTRATION</h2>
  <p>Welcome, Admin.</p>
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

  while ($row = mysqli_fetch_array($data)) { 

    echo '<tr><td class="scorerow"><td><strong>' . $row['name'] . '</strong></td>' ;
    echo '<td>' . $row['date'] . '</td>';
    echo '<td>' . $row['score'] . '</td>';
    echo '<td><a href = "removescore.php?id=' . $row['id'] . '&amp; date=' . $row['date'] . '&amp; name=' . $row['name'] . '&amp; score=' . $row['score'] . '&amp; screenshot=' . $row['screenshot'] .' "> Remove </a></td></tr>';
   
  }
  echo '</table>';

  mysqli_close($dbc);
?>
</div>
</body> 
</html>
