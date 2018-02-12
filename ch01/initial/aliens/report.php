<html>
<head>
	<title>Aliens Abducted Me - Report an Abduction</title>
</head>
<body>
	<h2>Aliens Abducted Me - Report an Abduction</h2>

	<?php
		$when_it_happened = $_POST['whenithappened'];
		$how_long = $_POST['howlong'];
		$alien_description = $_POST['aliendescription'];
		$fang_spotted = $_POST['fangspotted'];
		$email = $_POST['email'];
		$how_many = $_POST['howmany'];
		$what_they_did = $_POST['whattheydid'];
		$other = $_POST['other'];
		$name = $_POST['firstname'].' '.$_POST['lastname'];
		$firstname = $_POST['firstname'];
		$lastname = $_POST['lastname'];
		
		$dbc = mysqli_connect('localhost','root','','aliendatabase')
		or die('Error connecting to MYSQL server');

		$query = "INSERT INTO `aliens_abduction`(`first_name`, `last_name`," .
		" `when_it_happened`, `how_long`, `how_many`, `alien_description`," .
		" `what_they_did`, `fang_spotted`, `other`, `email`) VALUES ('$firstname',".
		"'$lastname','$when_it_happened','$how_long','$how_many','$alien_description','$what_they_did','$fang_spotted',".
		"'$other','$email')";

		$result = mysqli_query($dbc, $query)
		or die('Error querying database');

		mysqli_close($dbc);

		echo 'Thanks for submitting the form '. $name .'<br/>';
		echo 'You were abducted '. $when_it_happened;
		echo ' and were gone for '. $how_long . '<br/>';
		echo 'Number of aliens: ' . $how_many . '<br/>';
		echo 'Describe them: ' . $alien_description . '<br/>';
		echo 'The aliens did this: ' .$what_they_did . '<br/>'; 
		echo 'Was Fang there? ' . $fang_spotted . '<br/>';
		echo 'Other comments: ' . $other . '<br/>';
		echo 'Your email address is ' . $email;
	
	
	?>
</body>
</html>