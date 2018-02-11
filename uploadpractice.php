<?php
	if (isset($_POST['submit'])) {
		$file = $_FILES['file'];

		$fileName = $_FILES['file']['name'];
		$filetmp = $_FILES['file']['tmp_name'];
		$fileSize = $_FILES['file']['size'];
		$fileError = $_FILES['file']['error'];
		$fileType = $_FILES['file']['type'];

		$description = $_POST['description'];

		$allowed = array('jpg','jpeg','png','pdf');

			if ($fileError === 0) {
				if ($fileSize < 500000) {
					
					$fileDestination = 'uploads/'.$fileName;
					move_uploaded_file($filetmp, $fileDestination);

					$dbc = mysqli_connect('localhost','root','','upload_practice');
					$query = "INSERT INTO `upload`(`description`, `picture`) VALUES ('$description','$fileName')";
					mysqli_query($dbc,$query);
					mysqli_close($dbc);

					header("Location: index.php?uploadSuccess");
				}else{
					echo "Your file is too big";
				}
			}else{
				echo "There is an error uploading the file";
			}
		
	}
?>