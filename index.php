<!DOCTYPE html>
<html>
<head>
	<title>
		Upload File to Mysql database practice	
	</title>
</head>
<body>
	<form action="uploadpractice.php" method="post" enctype="multipart/form-data" >
		<br/>
		<input type="file" name="file">
		<br/>
		<br/>
		<input type="text" name="description" placeholder="Please Describe the image">
		<br/>
		<br/>
		<button type="submit" name="submit">Upload</button>
		<br/>
		<br/>
	</form>
</body>
</html>

<?php
	$dbc = mysqli_connect('localhost','root','','upload_practice');
	$r = array();
	$query = "SELECT * FROM upload";
	$result = mysqli_query($dbc,$query);
	while($row = mysqli_fetch_array($result)){
		echo $row[1];
		?>
		<br/> 
		<img src="uploads/<?php echo $row[3] ?>"> <br/> <br/>  <?php
	}
	
	
	mysqli_close($dbc);
?>