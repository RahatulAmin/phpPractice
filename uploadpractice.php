<?php
	if (isset($_POST['submit'])) {
		$file = $_FILES['file'];

		$fileName = $_FILES['file']['name'];
		$filetmp = $_FILES['file']['tmp_name'];
		$fileSize = $_FILES['file']['size'];
		$fileError = $_FILES['file']['error'];
		$fileType = $_FILES['file']['type'];

		// $fileExt = explode('.', '$fileName');
		// $fileActualExt = strtolower(end($fileExt));

		$allowed = array('jpg','jpeg','png','pdf');

		 // if (in_array($fileActualExt, $allowed)) {
			if ($fileError === 0) {
				if ($fileSize < 500000) {
					
					$fileDestination = 'uploads/'.$fileName;
					move_uploaded_file($filetmp, $fileDestination);
					header("Location: index.php?uploadSuccess");
				}else{
					echo "Your file is too big";
				}
			}else{
				echo "There is an error uploading the file";
			}
		  // }else{
		  // 	echo "File type not supported";
		  // }
	}
?>