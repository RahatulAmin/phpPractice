<?php

if (isset($_COOKIE['username'])) {
	setcookie('username','',time()-3600);
	setcookie('user_id','',time()-3600);
}
 $home_url = 'http://' . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']) . '/index.php';
 header('Location: ' . $home_url);

?>