<?php
	if(isset($_POST['Submit'])){
	$from = 'elmer@makemeelvis.com';
	$subject = $_POST['subject'];
	$text = $_POST['elvismail'];
	$output_form = false; 

	if(empty($text) && empty($subject)){
		$output_form = true; 
		echo 'Missing Text & Subject';
	}

	if(empty($subject) && !empty($text)){
		$output_form = true; 
		echo 'Missing Subject'.'<br/>';
	}

	if(empty($text) && !empty($subject)){
		$output_form = true; 
		echo 'Missing Text';
	}
	
	if((!empty($subject)) && (!empty($text))){
			$dbc = mysqli_connect('localhost','root','','elvis_store')
			or die('Cannot connect');

			$query = "SELECT * FROM email_list";

			$result = mysqli_query($dbc, $query)
			or die('Cannot connect');	

			while($row = mysqli_fetch_array($result)){
				$first_name = $row['first_name'];
				$last_name = $row['last_name'];
				$message = "Dear $first_name $last_name, \n $text";
				$to = $row['email']; 
				mail($to, $subject, $message, 'From: ' . $from);
				echo 'Email sent to: '. $to . '<br/>';
			}
			mysqli_close($dbc);
		}
			
	}
	else
	{
		$output_form = true;
	}

	if($output_form)
	{
		?>
		<form action=" <?php echo $_SERVER['PHP_SELF']; ?>" method="post" >
	    <label for="subject">Subject of email:</label><br />
	    <input id="subject" name="subject" type="text" size="30" value ="<?php echo $subject ?>" /><br />
	    <label for="elvismail">Body of email:</label><br />
	    <textarea id="elvismail" name="elvismail" rows="8" cols="40"><?php echo $text; ?></textarea><br />
	    <input type="submit" name="Submit" value="Submit" />
	  </form>

		<?php
	}
?>