<?php
require_once('connectvars.php');

if (!isset($_SERVER['PHP_AUTH_USER']) || !isset($_SERVER['PHP_AUTH_PW'])) {
	header('HTTP/1.1 401 Unauthorized');
	header('WWW-Authenticate: Basic realm="Mismatch"');
	exit('<p>Sorry, You have to enter a valid username and password to login. If you aren\'t a registered member, please <a href="signup.php">sign up</a>.</p>');
}

$dbc = mysqli_connect('localhost', 'root','','mismatchdb');

$user_username = mysqli_real_escape_string($dbc, trim($_SERVER['PHP_AUTH_USER']));
$user_password = mysqli_real_escape_string($dbc, trim($_SERVER['PHP_AUTH_PW']));

$query = "SELECT user_id, username FROM mismatch_user Where username =" .
"'$user_username' AND password = SHA('$user_password')";

$data = mysqli_query($dbc,$query);

if (mysqli_num_rows($data) == 1) {
	$row = mysqli_fetch_array($data);
	$user_id = $row['user_id'];
	$username = $row['username'];
}else{
	header('HTTP/1.1 401 Unauthorized');
	header('WWW-Authenticate: Basic realm="Mismatch"');
	exit('<p>Sorry, You have to enter a valid username and password to login. If you aren\'t a registered member, please <a href="signup.php">sign up</a>.</p>');
}

echo '<p>You are logged in as <a href="editprofile.php"> '.$username.'. </a></p>' ; 

?>