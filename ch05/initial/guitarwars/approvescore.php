<?php

require_once('authorize.php');
require_once('appvars.php');

if(isset($_GET['id']) && isset($_GET['date']) && isset($_GET['name']) && isset($_GET['score']) && isset($_GET['screenshot'])){

$id = $_GET['id'];
$date = $_GET['date'];
$name = $_GET['name'];
$score = $_GET['score'];
$screenshot = $_GET['screenshot'];

}

else if (isset($_POST['id']) && isset($_POST['name']) && isset($_POST['score'])){

$id = $_POST['id'];
$name = $_POST['name'];
$score = $_POST['score'];

}else{
	echo '<p class="error">Sorry, No High Score was specified </p>' ;
}

if(isset($_POST['submit'])) {
	if ($_POST['confirm'] == 'Yes') {
		require_once('connect.php');
		$query = "UPDATE guitarwars SET approved = 1 WHERE id = $id ";
		mysqli_query($dbc, $query);
		mysqli_close($dbc);
		echo '<p class="error">The High Score was Approved</p> ';
	}
	else
	{
		echo '<p class="error">The High Score was not Approved</p> ';
	}
}

echo '<p><a href= "admin.php">&lt;&lt; Back to Admin Page</a></p>';


if (isset($id) && isset($name) && isset($score) && isset($date) && isset($screenshot)) {
	
	echo '<p>Are you sure you want to Approve the High Score?</p>';
	echo '<p><strong>Name:</strong>' . $name . '</p></br>';
	echo '<p><strong>Score:</strong>' . $score . '</p>';
	?>

	<form method="post" action="approvescore.php">
		<input type="radio" name="confirm" value="Yes" /> Yes 
		<input type="radio" name="confirm" value="No" /> No </br>
		<input type="submit" name="submit" value="Submit" />  
<?php
		echo '<input type="hidden" name="id" value=" '.$id.' " >';
		echo '<input type="hidden" name="name" value=" '.$name.' " >';
		echo '<input type="hidden" name="score" value=" '.$score.' " >';
	}
	echo "<p><a href= 'admin.php' >&lt;&lt; Back to admin Page</a></p>" ;
	?>

	</form>




