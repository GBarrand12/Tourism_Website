<?php
	unset($_SESSION['admin']);
	unset($_SESSION);
	
	if(!headers_sent()) {
		header('Location: index.php');
		exit;
	} else {
		echo '<script type="text/javascript">';
		echo 'window.location.href="index.php";';
		echo '</script>';
		echo '<noscript>';
		echo '<meta http-equiv="refresh" content="0;url="index.php" />';
		echo '</noscript>'; exit;
	}

?>