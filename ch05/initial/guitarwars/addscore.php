<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title>Guitar Wars - Add Your High Score</title>
  <link rel="stylesheet" type="text/css" href="style.css" />
</head>
<body>
  <h2>Guitar Wars - Add Your High Score</h2>

<?php
define('GW_UPLOADPATH', 'images/');

  if (isset($_POST['submit'])) {
    // Grab the score data from the POST
    $name = $_POST['name'];
    $score = $_POST['score'];
    $file = $_FILES['screenshot'];

    $fileName = $_FILES['screenshot']['name'];
    $filetmp = $_FILES['screenshot']['tmp_name'];
    $fileSize = $_FILES['screenshot']['size'];
    $fileError = $_FILES['screenshot']['error'];
    $fileType = $_FILES['screenshot']['type'];

   
    

    if (!empty($name) && !empty($score) && !empty($file)) {
      // Connect to the database
      if(($fileType == 'image/gif') || ($fileType == 'image/jpeg') || ($fileType == 'image/pjpeg') || ($fileType == 'image/png') && ($fileSize > 0) && ($fileSize <= 1000000)){ 
        if ($fileError == 0) {
          
    
      $fileDestination = 'images/'.$fileName;
      move_uploaded_file($filetmp, $fileDestination);

      require_once('connect.php');

      // Write the data to the database
      $query = "INSERT INTO guitarwars VALUES (0, NOW(), '$name', '$score', '$fileName')";
      mysqli_query($dbc, $query);

      // Confirm success with the user
      echo '<p>Thanks for adding your new high score!</p>';
      echo '<p><strong>Name:</strong> ' . $name . '<br />';
      echo '<strong>Score:</strong> ' . $score . '</p>';
      echo '<strong>Screenshot:</strong> ' ;
      ?>
      <img src="images/<?php echo $fileName ?>" > <?php '</p>';
      echo '<p><a href="index.php">&lt;&lt; Back to high scores</a></p>';

      // Clear the score data to clear the form
      $name = "";
      $score = "";
      $shot = "";

      mysqli_close($dbc);
    }else{
      echo "There was an error uploading the file";
    }
    }else{
      echo "File Type not supported or too big";
    }
    
      
    
  } else
  {
    echo "There was a problem uploading the file";
  }
  }
?>

  <hr />
  <form enctype="multipart/form-data" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
    <input type="hidden" name="MAX_FILE_SIZE" value="32768">
    <label for="name">Name:</label>
    <input type="text" id="name" name="name" value="<?php if (!empty($name)) echo $name; ?>" /><br />
    <label for="score">Score:</label>
    <input type="text" id="score" name="score" value="<?php if (!empty($score)) echo $score; ?>" />
    <br/>
    <label for="screenshot">Screen Shot: </label>
    <input type="file" id="screenshot" name="screenshot">
    <hr />
    <input type="submit" value="Add" name="submit" />
  </form>
</body> 
</html>
