<?php
	if(isset($_REQUEST['login'])) {
		extract($_POST);
		
		// Write query to check that username and password matches one in database
		$login_sql = "SELECT * FROM admin WHERE username = '$username' AND password = '".sha1($password)."'";
		
		// Run the query
		$login_query = mysqli_query($dbc, $login_sql);
		
		// If the query returns false, the username and password combo are incorrect
		// Check that query worked
		if(!$login_query) {
			echo "Incorrect username or password";
		} else {// if query worked i.e username and password match what's in the database
			if(mysqli_num_rows($login_query) > 0) {
				// organise data into an array
				$rsLogin = mysqli_fetch_assoc($login_query);
				// start a session called admin, storing the username
				$_SESSION['admin'] = $rsLogin['username'];
				//echo "Success"; //check it works
			} else {
				// redirect to login page with error message showing
				if (!headers_sent()) {
					header('Location: admin.php?page=login$error=login');
					exit;
				} else {
					echo '<script type="text/javascript">';
					echo 'window.location.href="admin.php?page=login&error=login";';
					echo '</script>';
					echo '<noscript>';
					echo '<meta http-equiv="refresh"content="0;url="admin.php?page=login&error=login" />';
					echo '</noscript>'; exit;
				}
				
			unset($_SESSION);
			
			}			
				
		}		
	}
	// if login failed, include login page
	if(!isset($_SESSION['admin'])) {
		include("login.php");
	} else {
		// login was successful - include admin panel
		include("adminpanel.php");
	}
	
?>
