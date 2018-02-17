<?php
require_once('connectvars.php');

session_start();
$error_msg="";
if(!isset($_SESSION['user_id'])){
	if(isset($_POST['submit'])){
		$dbc = mysqli_connect('localhost', 'root','','mismatchdb');

		$user_username = mysqli_real_escape_string($dbc, trim($_POST['username']));
		$user_password = mysqli_real_escape_string($dbc, trim($_POST['password']));

		if (!empty($user_username) && !empty($user_password)) {
		
		$query = "SELECT user_id, username FROM mismatch_user Where username =" .
		"'$user_username' AND password = SHA('$user_password')";

		$data = mysqli_query($dbc,$query);

		if (mysqli_num_rows($data) == 1) {
			$row = mysqli_fetch_array($data);
			$_SESSION['user_id'] = $row['user_id'];
			$_SESSION['username'] = $row['username'];
			$home_url = 'http://' . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']) . '/index.php?<?php echo SID; ?>';
 			header('Location: ' . $home_url);
		}else{
			$error_msg = 'Sorry, you must enter a valid username and password to log in.';
		}
	} else{
		$error_msg = 'Sorry, you must enter a valid username and password to log in.';
	}
	}
}


?>

<!DOCTYPE html>
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title>Mismatch - Where opposites attract!</title>
  <link rel="stylesheet" type="text/css" href="style.css" />
</head>
<body>
  <h3>Mismatch - Login</h3>

<?php
 // If the cookie is empty, show any error message and the log-in form; otherwise confirm the log-in
 if (empty($_SESSION['user_id'])) {
 echo '<p class="error">' . $error_msg . '</p>';
?>
 <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
 <fieldset>
 <legend>Log In</legend>
 <label for="username">Username:</label>
 <input type="text" id="username" name="username"
 value="<?php if (!empty($user_username)) echo $user_username; ?>" /><br />
 <label for="password">Password:</label>
 <input type="password" id="password" name="password" />
 </fieldset>
 <input type="submit" value="Log In" name="submit" />
 </form>
<?php
 }
 else {
 // Confirm the successful log in
 echo('<p class="login">You are logged in as ' . $_SESSION['username'] . '.</p>');
 }


?>
</body>
</html>