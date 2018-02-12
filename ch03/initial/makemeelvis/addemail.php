<?php
	$dbc = mysqli_connect('localhost','root','','elvis_store')
	or die('Cannot connect');

	$first_name = $_POST['firstname'];
	$last_name = $_POST['lastname'];
	$email = $_POST['email'];

	$query = "INSERT INTO `email_list`(`first_name`, `last_name`, `email`) VALUES ('$first_name','$last_name','$email')";

	$result = mysqli_query($dbc, $query)
	or die('Cannot connect');	

	echo 'Customer Added';
		
	mysqli_close($dbc);

?>