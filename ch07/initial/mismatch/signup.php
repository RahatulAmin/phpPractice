<!DOCTYPE html >
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title>Mismatch - View Profile</title>
  <link rel="stylesheet" type="text/css" href="style.css" />
</head>
<body>
  <h3>Mismatch - SignUP</h3>


<?php
require_once('connectvars.php');
require_once('appvars.php');
 
 if (isset($_POST['submit'])) {
 	$username = $_POST['username'];
 	$password1 = $_POST['password1'];
 	$password2 = $_POST['password2'];

 	if(!empty($username) && !empty($password1) && !empty($password2) && ($password1 == $password2)){

 	$dbc = mysqli_connect('localhost','root','','mismatchdb');
 	$query = "SELECT * FROM mismatch_user WHERE username = '$username' ";
 	$data = mysqli_query($dbc, $query);
 	
 	if(mysqli_num_rows($data) == 0){

 		$query = "INSERT INTO `mismatch_user`(`username`, `password`, `join_date`) VALUES ('$username',SHA('$password1'), NOW())";
 		mysqli_query($dbc,$query);
 		echo '<p>You are registered, now you can <a href = "login.php"> login to your profile</a></p>' ;
 		mysqli_close($dbc);
 		exit();

 		}else{
 			echo '<p>Please try another username, this username is already taken</a></p>' ;
 			$username = '';
 		}
 	}else{
 		echo '<p class="error">You must enter all of the sign-up data, including the desired password ' .
 		'twice.</p>';
 }
}

?>

<form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST">

	<p>Please enter your information below</p>

	<label class="inp" ><input  type="text" name="username" placeholder="Username"></label></br>
	<label class="inp"><input  type="password" name="password1" placeholder="Password"></label></br>
	<label  class="inp"><input type="password" name="password2" placeholder="Confirm Password"></label></br>
	<input type="Submit" name="submit" value="Sign Up">
	
</form>

</body>
</html>