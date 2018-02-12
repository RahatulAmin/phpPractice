<?php
	$dbc = mysqli_connect('localhost','root','','aliendatabase')
	or die('Error connecting to MYSQL server');

	$query = "INSERT INTO `aliens_abduction`(`first_name`, `last_name`," .
	" `when_it_happened`, `how_long`, `how_many`, `alien_description`," .
	" `what_they_did`, `fang_spotted`, `other`, `email`) VALUES ('Garry',".
	"'Mills','14 Days ago','2 Days','4','green','tickled','no',".
	"'they were tall','garry@mills.com')";

	$result = mysqli_query($dbc, $query)
	or die('Error querying database');

	mysqli_close($dbc);
?>