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

if(isset($_POST['submit'])){
	if ($_POST['confirm'] == 'Yes') {
		@unlink(GW_UPLOADPATH.$screenshot);
		require_once('connect.php');
		$query = "DELETE FROM guitarwars WHERE id = $id LIMIT 1";
		mysqli_query($dbc, $query);
		mysqli_close($dbc);

		echo '<p class="error">The High Score was removed</p> ';
	}
	else
	{
		echo '<p class="error">The High Score was not removed</p> ';
	}
}

else if (isset($id) && isset($name) && isset($score) && isset($date) && isset($screenshot)) {
	
	echo '<p>Are you sure you want to delete the High Score?</p>';
	echo '<p><strong>Name:</strong>' . $name . '</p></br>';
	echo '<p><strong>Score:</strong>' . $score . '</p>';
	?>

	<form method="post" action="removescore.php">
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

